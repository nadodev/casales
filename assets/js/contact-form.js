(() => {
  const form = document.querySelector('[data-contact-form]');
  if (!form) return;
  const status = form.querySelector('[data-form-status]');
  const showError = (field, message) => { const error = document.getElementById(`${field.id}-error`); field.setAttribute('aria-invalid', String(Boolean(message))); if (error) error.textContent = message; };
  form.addEventListener('submit', (event) => {
    event.preventDefault();
    let valid = true;
    [...form.elements].filter((field) => field.matches('[required]')).forEach((field) => {
      let message = field.validity.valueMissing ? 'Este campo é obrigatório.' : '';
      if (!message && field.validity.typeMismatch) message = 'Informe um e-mail válido.';
      showError(field, message); valid = valid && !message;
    });
    if (!valid) { status.textContent = 'Revise os campos destacados.'; form.querySelector('[aria-invalid="true"]')?.focus(); return; }
    const submit = form.querySelector('[type="submit"]'); submit.disabled = true; submit.textContent = 'Enviando…'; status.textContent = 'Simulando o envio com segurança…';
    window.setTimeout(() => { form.reset(); submit.disabled = false; submit.textContent = 'Enviar mensagem'; status.textContent = 'Mensagem registrada com sucesso. Esta é uma simulação; nenhum dado foi enviado.'; }, 700);
  });
})();
