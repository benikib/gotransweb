const passwordInput = document.getElementById('password');

if (passwordInput) {
  passwordInput.addEventListener('input', function () {
    const password = this.value;

    const rules = {
      length: password.length >= 8,
      uppercase: /[A-Z]/.test(password),
      lowercase: /[a-z]/.test(password),
      number: /[0-9]/.test(password),
      special: /[\W_]/.test(password),
    };

    let score = 0;

    for (let rule in rules) {
      const item = document.getElementById(rule);
      if (!item) continue; // sécurité en plus
      if (rules[rule]) {
        item.classList.remove('text-danger', 'invalid');
        item.classList.add('text-success', 'valid');
        score++;
      } else {
        item.classList.remove('text-success', 'valid');
        item.classList.add('text-danger', 'invalid');
      }
    }

    const progressBar = document.getElementById('strength-bar');
    if (progressBar) {
      const percentage = (score / 5) * 100;
      progressBar.style.width = percentage + '%';

      if (percentage < 40) {
        progressBar.className = 'progress-bar bg-danger';
      } else if (percentage < 80) {
        progressBar.className = 'progress-bar bg-warning';
      } else {
        progressBar.className = 'progress-bar bg-success';
      }
    }
  });
}
