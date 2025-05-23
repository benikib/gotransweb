import './bootstrap';
// resources/js/app.js
import 'bootstrap';



import Alpine from 'alpinejs';




window.Alpine = Alpine;

Alpine.start();

document.getElementById('password').addEventListener('input', function () {
    const password = this.value;

    // Règles
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
        if (rules[rule]) {
            item.classList.remove('text-danger');
            item.classList.add('text-success');
            item.classList.add('valid');
            item.classList.remove('invalid');
            score++;
        } else {
            item.classList.remove('text-success');
            item.classList.add('text-danger');
            item.classList.add('invalid');
            item.classList.remove('valid');
        }
    }

    // Mettre à jour la barre de progression
    const progressBar = document.getElementById('strength-bar');
    const percentage = (score / 5) * 100;
    progressBar.style.width = percentage + '%';

    if (percentage < 40) {
        progressBar.className = 'progress-bar bg-danger';
    } else if (percentage < 80) {
        progressBar.className = 'progress-bar bg-warning';
    } else {
        progressBar.className = 'progress-bar bg-success';
    }
});




//Les fonctions js pour l'affectation vehicule

