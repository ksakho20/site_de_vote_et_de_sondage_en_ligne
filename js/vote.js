document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('vote-form');
  const resultsDiv = document.getElementById('results');

  function renderResults(poll) {
    let html = '<h2>Résultats</h2>';
    poll.questions.forEach((q) => {
      html += `<h3>${q.label}</h3>`;
      const total = q.options.reduce((s,o)=>s+o.votes,0);
      q.options.forEach(opt => {
        const pct = total ? ((opt.votes/total)*100).toFixed(1) : 0;
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
    const data = new URLSearchParams(new FormData(form));
    const resp = await fetch('vote.php', {method:'POST', body:data});
    const json = await resp.json();
    if (json.status==='success') renderResults(json.poll);
    else alert(json.message);
  });

  // Rafraîchissement périodique
  const pollId = new URLSearchParams(window.location.search).get('id');
  setInterval(async () => {
    const resp = await fetch(`results.php?id=${encodeURIComponent(pollId)}`);
    renderResults(await resp.json());
  }, 10000);
});
