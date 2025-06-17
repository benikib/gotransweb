<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
    {{-- <link rel="stylesheet" href="{{ resources('resources/css/app.css') }}"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
      <!-- Inclure Bootstrap via Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        #password-criteria li.valid {
    color: green;
}
#password-criteria li.invalid {
    color: red;
}
    </style>
</head>
<body style="font-family: 'Inter', sans-serif;" class="bg-light">

    <div class="min-vh-100 d-flex justify-content-center align-items-center p-3">
        <div class="card shadow-lg rounded-4 w-100" style="max-width: 450px;">
            <div class="card-header bg-primary tex t-white text-center p-4 animate__animated animate__fadeInDown">
                <h2 class="fw-bold mb-0">Créer un compte</h2>
                <p class="text-light mb-0">Créer un SuperAdmin</p>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="">
                    @csrf

                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"  autofocus>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mot de passe -->

                    <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" required>
    <small id="passwordHelpBlock" class="form-text text-muted">
        Le mot de passe doit contenir au moins :
    </small>
    <ul id="password-criteria" class="list-unstyled small text-muted">
        <li id="length" class="text-danger">8 caractères minimum</li>
        <li id="uppercase" class="text-danger">1 lettre majuscule</li>
        <li id="lowercase" class="text-danger">1 lettre minuscule</li>
        <li id="number" class="text-danger">1 chiffre</li>
        <li id="special" class="text-danger">1 caractère spécial</li>
    </ul>
    {{-- <div class="progress mt-2">
        <div id="strength-bar" class="progress-bar" style="width: 0%;"></div>
    </div> --}}
    @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
</div>


                    {{-- <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <!-- Confirmation -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('login') }}" class="text-decoration-underline text-secondary small">Déjà inscrit ?</a>
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
</script>

</body>
</html>
