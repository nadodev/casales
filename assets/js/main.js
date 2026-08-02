import logoUrl from '../images/logo-clean.png';
import clinicUrl from '../images/clinica-real-optimized.jpg';
import sergioUrl from '../images/profissional-sergio-optimized.jpg';
import andresaUrl from '../images/profissional-andresa-optimized.jpg';
import giovaniUrl from '../images/profissional-giovani-optimized.jpg';

(() => {
  const page = document.body.dataset.page || '';
  const headerHost = document.querySelector('[data-site-header]');
  const footerHost = document.querySelector('[data-site-footer]');
  queueMicrotask(() => {
    const headerBrand = headerHost?.querySelector('a[aria-label^="Casale"]');
    if (headerBrand) headerBrand.innerHTML = `<img class="h-auto w-40 object-contain sm:w-48" src="${logoUrl}" width="1868" height="842" alt="Casale Saúde Integrada">`;
    const footerBrand = footerHost?.querySelector('footer .container-site > div');
    if (footerBrand) footerBrand.innerHTML = `<img class="h-auto w-52 object-contain" src="${logoUrl}" width="1868" height="842" alt="Casale Saúde Integrada"><p class="mt-3 text-sm text-white/75">Odontologia, fisioterapia e acupuntura em um cuidado humano e integrado.</p>`;
    const imageReplacements = [
      ['placeholder-clinica.svg', clinicUrl, 'Ambiente acolhedor de uma clínica integrada'],
      ['placeholder-sergio.svg', sergioUrl, 'Dr. Sérgio Casale em ambiente clínico'],
      ['placeholder-andresa.svg', andresaUrl, 'Dra. Andresa Rossilho Casale em ambiente clínico'],
      ['placeholder-giovani.svg', giovaniUrl, 'Dr. Giovani Rossilho Casale em ambiente clínico'],
    ];
    document.querySelectorAll('img').forEach((image) => {
      const replacement = imageReplacements.find(([source]) => image.getAttribute('src')?.endsWith(source));
      if (!replacement) return;
      image.src = replacement[1];
      image.alt = replacement[2];
    });
  });
  const treatmentLinks = `<a href="tratamentos.html">Visão geral</a><a href="tratamento-odontologico.html">Odontologia</a><a href="tratamento-fisioterapeutico.html">Fisioterapia</a><a href="tratamento-acupuntura.html">Acupuntura</a><a href="cuidado-integrado.html">Cuidado integrado</a>`;
  if (headerHost) headerHost.innerHTML = `<header class="site-header sticky top-0 z-50 border-b border-green-900/10 bg-surface/95 transition" aria-label="Cabeçalho"><div class="container-site flex min-h-20 items-center justify-between"><a class="flex items-center gap-3" href="index.html" aria-label="Casale Saúde Integrada — início"><span class="grid h-11 w-11 place-items-center rounded-full border border-gold-600 font-display text-2xl font-bold text-green-900">C</span><span><strong class="block font-display text-xl leading-none">Casale</strong><small class="text-[10px] uppercase tracking-[.16em]">Saúde Integrada</small></span></a><nav class="hidden items-center gap-7 lg:flex" aria-label="Principal"><a class="nav-link" href="index.html" ${page==='inicio'?'aria-current="page"':''}>Início</a><a class="nav-link" href="profissionais.html" ${page==='profissionais'?'aria-current="page"':''}>Profissionais</a><div class="relative"><button class="nav-link flex items-center gap-1" data-submenu-button aria-expanded="false" aria-controls="desktop-treatments">Tratamentos <span aria-hidden="true">⌄</span></button><div id="desktop-treatments" hidden class="absolute right-0 top-full w-64 rounded-xl border border-green-900/10 bg-white p-3 shadow-soft [&_a]:block [&_a]:rounded-lg [&_a]:px-3 [&_a]:py-2 [&_a]:text-sm [&_a:hover]:bg-surface">${treatmentLinks}</div></div><a class="nav-link" href="contato.html" ${page==='contato'?'aria-current="page"':''}>Contato</a><a class="btn-primary" href="contato.html#formulario">Agendar consulta</a></nav><button class="rounded-lg border border-green-900/20 p-3 lg:hidden" data-menu-button aria-expanded="false" aria-controls="mobile-menu"><span class="sr-only">Abrir menu</span><span aria-hidden="true">☰</span></button></div><nav id="mobile-menu" hidden data-mobile-menu class="border-t border-green-900/10 bg-white px-5 py-5 lg:hidden" aria-label="Menu móvel"><div class="flex flex-col gap-1 [&_a]:rounded-lg [&_a]:px-3 [&_a]:py-3"><a href="index.html">Início</a><a href="profissionais.html">Profissionais</a><button class="flex justify-between rounded-lg px-3 py-3 text-left" data-submenu-button aria-expanded="false" aria-controls="mobile-treatments">Tratamentos <span>⌄</span></button><div id="mobile-treatments" hidden class="ml-3 border-l border-beige-300 pl-3 [&_a]:block">${treatmentLinks}</div><a href="contato.html">Contato</a><a class="btn-primary mt-3" href="contato.html#formulario">Agendar consulta</a></div></nav></header>`;
  if (footerHost) footerHost.innerHTML = `<footer class="bg-green-900 py-14 text-white"><div class="container-site grid gap-10 md:grid-cols-2 lg:grid-cols-4"><div><p class="font-display text-3xl">Casale</p><p class="mt-3 text-sm text-white/75">Odontologia, fisioterapia e acupuntura em um cuidado humano e integrado.</p></div><div><h2 class="font-sans text-sm font-bold uppercase tracking-wider">Navegação</h2><nav class="mt-3 grid gap-2 text-sm text-white/75"><a href="profissionais.html">Profissionais</a><a href="tratamentos.html">Tratamentos</a><a href="contato.html">Contato</a></nav></div><div><h2 class="font-sans text-sm font-bold uppercase tracking-wider">Contato</h2><div class="mt-3 grid gap-2 text-sm text-white/75"><a href="tel:+551934242812">(19) 3424-2812</a><a href="mailto:casalesaudeintegrada@gmail.com">casalesaudeintegrada@gmail.com</a><address class="not-italic">R. Alexandre Francoso, 55<br>Dois Córregos, Piracicaba — SP</address></div></div><div><h2 class="font-sans text-sm font-bold uppercase tracking-wider">Acompanhe</h2><div class="mt-3 grid gap-2 text-sm text-white/75"><a href="https://www.instagram.com/casalesaudeintegrada/" rel="noopener noreferrer">Instagram</a><a href="https://www.linkedin.com/search/results/all/?keywords=Casale%20Sa%C3%BAde%20Integrada" rel="noopener noreferrer">LinkedIn</a><a href="privacidade.html">Política de Privacidade</a><a href="termos.html">Termos de Uso</a></div></div></div><div class="container-site mt-10 border-t border-white/15 pt-6 text-xs text-white/60">© <span data-year></span> Casale Saúde Integrada. Todos os direitos reservados.</div></footer><a class="fixed bottom-5 right-5 z-40 grid h-14 w-14 place-items-center rounded-full bg-green-700 text-sm font-bold text-white shadow-soft" href="https://wa.me/551934242812?text=Ol%C3%A1%2C%20gostaria%20de%20saber%20mais%20sobre%20os%20atendimentos." aria-label="Conversar pelo WhatsApp">WA</a>`;
  const header = document.querySelector('.site-header');
  const menuButton = document.querySelector('[data-menu-button]');
  const mobileMenu = document.querySelector('[data-mobile-menu]');
  const submenuButtons = document.querySelectorAll('[data-submenu-button]');

  const setMenu = (open) => {
    if (!menuButton || !mobileMenu) return;
    menuButton.setAttribute('aria-expanded', String(open));
    mobileMenu.hidden = !open;
    document.body.classList.toggle('menu-open', open);
  };
  menuButton?.addEventListener('click', () => setMenu(menuButton.getAttribute('aria-expanded') !== 'true'));
  mobileMenu?.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setMenu(false)));

  submenuButtons.forEach((button) => {
    const panel = document.getElementById(button.getAttribute('aria-controls'));
    button.setAttribute('aria-haspopup', 'true');
    panel?.setAttribute('aria-label', 'Opções de tratamentos');
    button.addEventListener('click', (event) => {
      event.stopPropagation();
      const open = button.getAttribute('aria-expanded') !== 'true';
      submenuButtons.forEach((other) => { other.setAttribute('aria-expanded', 'false'); document.getElementById(other.getAttribute('aria-controls'))?.setAttribute('hidden', ''); });
      button.setAttribute('aria-expanded', String(open));
      if (panel) panel.hidden = !open;
    });
    button.addEventListener('keydown', (event) => {
      if (event.key !== 'ArrowDown') return;
      event.preventDefault();
      if (button.getAttribute('aria-expanded') !== 'true') button.click();
      panel?.querySelector('a')?.focus();
    });
    panel?.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') button.focus();
    });
  });
  document.addEventListener('click', () => submenuButtons.forEach((button) => { button.setAttribute('aria-expanded', 'false'); document.getElementById(button.getAttribute('aria-controls'))?.setAttribute('hidden', ''); }));
  document.addEventListener('keydown', (event) => { if (event.key === 'Escape') { setMenu(false); submenuButtons.forEach((button) => { button.setAttribute('aria-expanded', 'false'); document.getElementById(button.getAttribute('aria-controls'))?.setAttribute('hidden', ''); }); } });
  window.addEventListener('scroll', () => header?.classList.toggle('scrolled', window.scrollY > 12), { passive: true });
  document.querySelectorAll('[data-accordion-button]').forEach((button) => button.addEventListener('click', () => {
    const panel = document.getElementById(button.getAttribute('aria-controls'));
    const open = button.getAttribute('aria-expanded') !== 'true';
    button.setAttribute('aria-expanded', String(open));
    if (panel) panel.hidden = !open;
  }));
  document.querySelectorAll('[data-year]').forEach((node) => { node.textContent = new Date().getFullYear(); });
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!reducedMotion && 'IntersectionObserver' in window) {
    document.documentElement.classList.add('motion-ready');
    const animatedSections = document.querySelectorAll('main > section');
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px' });
    animatedSections.forEach((section) => {
      section.classList.add('reveal-section');
      section.querySelectorAll('.card, .differential-item').forEach((item) => item.classList.add('reveal-item'));
      revealObserver.observe(section);
    });
  }
})();
