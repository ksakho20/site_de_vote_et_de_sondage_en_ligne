  document.addEventListener('DOMContentLoaded', () => {
    const form       = document.getElementById('vote-form');
    const resultsDiv = document.getElementById('results');
  
    // Fonction qui render les résultats sous forme de barres
    function renderResults(poll) {
      const total = poll.options.reduce((sum, o) => sum + o.votes, 0);
      let html = '<h2>Résultats</h2>';
      poll.options.forEach(opt => {
        const pct = total ? ((opt.votes / total) * 100).toFixed(1) : 0;
        html += `
          <div>
            <strong>${opt.label}</strong> : ${opt.votes} vote(s) (${pct}%)
            <div style="background:#ddd;width:100%;height:8px;margin:4px 0">
              <div style="background:#3b82f6;width:${pct}%;height:100%"></div>
            </div>
          </div>`;
      });
      resultsDiv.innerHTML = html;
    }
  
    // Gestion du submit
    form.addEventListener('submit', async e => {
      e.preventDefault();
      const data = new URLSearchParams(new FormData(form));
      const resp = await fetch('vote.php', {
        method: 'POST',
        body: data
      });
      const json = await resp.json();
      if (json.status === 'success') {
        renderResults(json.poll);
      } else {
        alert(json.message);
      }
    });
  
    // Actualisation périodique des résultats
    const pollId = new URLSearchParams(window.location.search).get('id');
    setInterval(async () => {
      const resp = await fetch(`results.php?id=${encodeURIComponent(pollId)}`);
      const poll = await resp.json();
      renderResults(poll);
    }, 10000);
  });
  
  function renderResults(poll) {
    const total = poll.options.reduce((s,o)=>s+o.votes,0);
    let html = '<h2>Résultats</h2>';
    poll.options.forEach(opt => {
      const pct = total ? (opt.votes/total*100).toFixed(1) : 0;
      html += `
        <div class="result">
          <div class="result-label">${opt.label} : ${opt.votes} (${pct}%)</div>
          <div class="bar"><div class="bar-inner" style="width:${pct}%"></div></div>
        </div>`;
    });
    resultsDiv.innerHTML = html;
  }
  