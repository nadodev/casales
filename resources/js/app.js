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
