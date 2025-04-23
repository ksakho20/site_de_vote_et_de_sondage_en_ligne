document.addEventListener('DOMContentLoaded', () => {
    console.log('create.js chargé – options');
    const container = document.getElementById('options-container');
    const btnAdd   = document.getElementById('add-option');
    if (!container || !btnAdd) return;
  
    btnAdd.addEventListener('click', () => {
      console.log('➕ clic sur Ajouter une option');
      const count = container.querySelectorAll('input[name="options[]"]').length + 1;
      const div = document.createElement('div');
      div.innerHTML = `<input type="text" name="options[]" placeholder="Option ${count}" required>`;
      container.appendChild(div);
    });
  });
  