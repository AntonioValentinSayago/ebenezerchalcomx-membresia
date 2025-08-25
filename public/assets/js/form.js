// public/assets/js/form.js
(() => {
  // Prettify talents -> pills preview
  const talents = document.querySelector('#talentos');
  const preview = document.querySelector('#talentosPreview');
  function renderPills(){
    if(!talents || !preview) return;
    preview.innerHTML = '';
    talents.value.split(',').map(s => s.trim()).filter(Boolean).forEach(t => {
      const span = document.createElement('span');
      span.className = 'badge rounded-pill text-bg-secondary me-1 mb-1';
      span.textContent = t;
      preview.appendChild(span);
    });
  }
  if (talents) {
    talents.addEventListener('input', renderPills);
    renderPills();
  }
})();
