import '@fontsource-variable/manrope';
const menuButton = document.querySelector('[data-menu-button]');
const menuBackdrop = document.querySelector('[data-menu-backdrop]');
const nav = document.querySelector('#main-nav');
const submenuButton = document.querySelector('[data-submenu-button]');
const submenu = document.querySelector('#treatment-menu');

const closeSubmenu = () => {
  if (!submenuButton || !submenu) return;
  submenu.hidden = true;
  submenuButton.setAttribute('aria-expanded', 'false');
};

const setMenu = (open) => {
  if (!menuButton || !nav) return;
  menuButton.setAttribute('aria-expanded', String(open));
  menuButton.querySelector('.sr-only').textContent = open ? 'Fechar menu' : 'Abrir menu';
  nav.classList.toggle('hidden', !open);
  menuBackdrop?.classList.toggle('hidden', !open);
  document.body.classList.toggle('menu-open', open);
  if (!open) closeSubmenu();
};

if (menuButton && nav) {
  menuButton.addEventListener('click', () => setMenu(menuButton.getAttribute('aria-expanded') !== 'true'));
  menuBackdrop?.addEventListener('click', () => setMenu(false));
  nav.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setMenu(false)));
}

if (submenuButton && submenu) {
  submenuButton.addEventListener('click', () => {
    const open = submenuButton.getAttribute('aria-expanded') !== 'true';
    submenu.hidden = !open;
    submenuButton.setAttribute('aria-expanded', String(open));
  });
  document.addEventListener('click', (event) => {
    if (!submenuButton.contains(event.target) && !submenu.contains(event.target)) closeSubmenu();
  });
}

document.addEventListener('keydown', (event) => {
  if (event.key !== 'Escape') return;
  closeSubmenu();
  setMenu(false);
  menuButton?.focus();
});

window.addEventListener('resize', () => {
  if (window.innerWidth >= 1024) {
    nav?.classList.remove('hidden');
    menuBackdrop?.classList.add('hidden');
    document.body.classList.remove('menu-open');
    menuButton?.setAttribute('aria-expanded', 'false');
  } else if (menuButton?.getAttribute('aria-expanded') !== 'true') {
    nav?.classList.add('hidden');
  }
});
document.querySelectorAll('form[data-confirm]').forEach(form=>form.addEventListener('submit',e=>{if(!window.confirm(form.dataset.confirm))e.preventDefault();}));
if(!document.querySelector('link[rel="icon"]')){const favicon=document.createElement('link');favicon.rel='icon';favicon.type='image/svg+xml';favicon.href='/favicon.svg';document.head.append(favicon);}

const notificationMeta = document.querySelector('meta[name="admin-notifications-url"]');
const unreadBadge = document.querySelector('[data-unread-badge]');
const notificationToast = document.querySelector('[data-admin-notification]');
if (notificationMeta && unreadBadge) {
  let previousUnread = Number(unreadBadge.textContent.trim()) || 0;
  let toastTimer;

  const refreshNotifications = async () => {
    if (document.hidden) return;
    try {
      const response = await fetch(notificationMeta.content, { headers: { Accept: 'application/json' }, cache: 'no-store' });
      if (!response.ok) return;
      const { unread } = await response.json();
      const count = Number(unread) || 0;
      unreadBadge.textContent = String(count);
      unreadBadge.classList.toggle('hidden', count === 0);

      if (count > previousUnread && notificationToast) {
        const received = count - previousUnread;
        notificationToast.textContent = received === 1 ? 'Você recebeu uma nova mensagem.' : `Você recebeu ${received} novas mensagens.`;
        notificationToast.classList.remove('hidden');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => notificationToast.classList.add('hidden'), 6000);
      }
      previousUnread = count;
    } catch (_) {
      // A próxima consulta tentará novamente sem interromper o painel.
    }
  };

  setInterval(refreshNotifications, 30000);
  document.addEventListener('visibilitychange', () => { if (!document.hidden) refreshNotifications(); });
}
