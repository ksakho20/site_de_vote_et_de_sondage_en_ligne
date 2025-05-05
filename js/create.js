document.addEventListener('DOMContentLoaded', () => {
  console.log('create.js chargé – options et questions');

  const optionContainer = document.getElementById('options-container');
  const questionContainer = document.getElementById('questions-container');
  const btnAddOption = document.getElementById('add-option');
  const btnAddQuestion = document.getElementById('add-question');

  // Ajout d'une option
  if (optionContainer && btnAddOption) {
    btnAddOption.addEventListener('click', () => {
      const count = optionContainer.querySelectorAll('input[name="options[]"]').length + 1;
      const div = document.createElement('div');
      div.innerHTML = `<input type="text" name="options[]" placeholder="Option ${count}" required>`;
      optionContainer.appendChild(div);
    });
  }

  //  Ajout d'une question
  if (questionContainer && btnAddQuestion) {
    btnAddQuestion.addEventListener('click', () => {
      const count = questionContainer.querySelectorAll('input[name="questions[]"]').length + 1;
      const div = document.createElement('div');
      div.innerHTML = `<input type="text" name="questions[]" placeholder="Question ${count}" required>`;
      questionContainer.appendChild(div);
    });
  }
});
