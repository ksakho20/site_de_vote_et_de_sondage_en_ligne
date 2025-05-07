document.addEventListener('DOMContentLoaded', () => {
  let qCount = 0;
  const questionsContainer = document.getElementById('questions-container');
  const tmpl = document.getElementById('question-template').innerHTML;

  // Fonction pour ajouter un nouveau bloc question
  function addQuestion() {
    const html = tmpl
      .replace(/{idx}/g, qCount)
      .replace(/{num}/g, qCount + 1);
    const wrapper = document.createElement('div');
    wrapper.innerHTML = html;
    questionsContainer.appendChild(wrapper.firstElementChild);
    attachOptionHandler(qCount);
    qCount++;
  }

  // Attacher le listener “Ajouter une option” pour une question donnée
  function attachOptionHandler(idx) {
    const btn = document.querySelector(`.btn-add-option[data-idx="${idx}"]`);
    const optsContainer = document.querySelector(`.question-block[data-idx="${idx}"] .options-container`);
    btn.addEventListener('click', () => {
      const optCount = optsContainer.querySelectorAll('input').length + 1;
      const div = document.createElement('div');
      div.className = 'field';
      div.innerHTML = `<input
        type="text"
        name="options[${idx}][]"
        placeholder="Option ${optCount}"
        required>`;
      optsContainer.appendChild(div);
    });
  }

  // Initialisation : ajoute la première question
  document.getElementById('add-question').addEventListener('click', addQuestion);
  addQuestion();
});
