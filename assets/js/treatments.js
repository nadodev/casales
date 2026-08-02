(() => {
  const buttons = document.querySelectorAll('[data-filter]');
  const cards = document.querySelectorAll('[data-category]');
  buttons.forEach((button) => button.addEventListener('click', () => {
    const filter = button.dataset.filter;
    buttons.forEach((item) => { item.setAttribute('aria-pressed', String(item === button)); item.classList.toggle('btn-primary', item === button); item.classList.toggle('btn-secondary', item !== button); });
    cards.forEach((card) => { card.hidden = filter !== 'todos' && card.dataset.category !== filter; });
  }));
})();
