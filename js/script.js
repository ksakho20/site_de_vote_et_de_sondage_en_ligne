document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('options-container');
    document.getElementById('add-option').addEventListener('click', () => {
      const count = container.querySelectorAll('input').length + 1;
      const div = document.createElement('div');
      div.innerHTML = `<input type="text" name="options[]" placeholder="Option ${count}" required>`;
      container.appendChild(div);
    });
  });
  