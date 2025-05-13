document.addEventListener('DOMContentLoaded', () => {
  const form       = document.getElementById('vote-form');
  const resultsDiv = document.getElementById('results');

  function renderResults(poll) {
    let html = '<h2>Résultats</h2>';
    poll.questions.forEach((q) => {
      html += `<h3>${q.label}</h3>`;
      const total = q.options.reduce((s,o) => s + o.votes, 0);
      q.options.forEach(opt => {
        const pct = total ? ((opt.votes / total) * 100).toFixed(1) : 0;
        html += `
          <div class="result">
            <div class="result-label">${opt.label} : ${opt.votes} (${pct}%)</div>
            <div class="bar"><div class="bar-inner" style="width:${pct}%"></div></div>
          </div>`;
      });
    });
    resultsDiv.innerHTML = html;
  }

  form.addEventListener('submit', async e => {
    e.preventDefault();

    // Récupère et désactive le bouton
    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.disabled = true;

    // Envoi Ajax
    const resp = await fetch('vote.php', {
      method: 'POST',
      body: new URLSearchParams(new FormData(form))
    });

    // 1. Blocage si clôturé (403)
    if (resp.status === 403) {
      const err = await resp.json();
      alert(err.message);
      form.classList.add('disabled');
      return;
    }

    // 2. Lecture du JSON
    const json = await resp.json();
    if (json.status === 'success') {
      // a) Mise à jour des résultats
      renderResults(json.poll);

      // b) Réactivation du bouton pour un nouveau vote
      submitBtn.disabled = false;

      // c) Toast de confirmation
      const toast = document.getElementById('toast');
      if (toast) {
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2000);
      }

      // d) Animation « pulse » sur la dernière barre
      const bars   = document.querySelectorAll('.bar-inner');
      const lastBar = bars[bars.length - 1];
      if (lastBar) {
        lastBar.classList.add('pulse');
        lastBar.addEventListener('animationend', () => {
          lastBar.classList.remove('pulse');
        }, { once: true });
      }

    } else {
      // en cas d’erreur côté API
      alert(json.message);
      submitBtn.disabled = false;
    }
  });

  // Rafraîchissement automatique toutes les 10 s
  const pollId = new URLSearchParams(window.location.search).get('id');
  setInterval(async () => {
    const resp = await fetch(`results.php?id=${encodeURIComponent(pollId)}`);
    renderResults(await resp.json());
  }, 10000);
});
