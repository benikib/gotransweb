{{-- resources/views/auth/email-sent.blade.php --}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation envoyée</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card shadow p-4" style="max-width: 500px;">
        <div class="card-body text-center">
            <h4 class="card-title text-success mb-3">📩 Email envoyé !</h4>
            <p class="card-text">
                Un lien de réinitialisation du mot de passe a été envoyé à votre adresse e-mail.
                <br>
                Veuillez consulter votre boîte de réception (ou les spams) et suivre le lien pour réinitialiser votre mot de passe.
            </p>
            <a href="{{ route('login') }}" class="btn btn-primary mt-3">Retour à la connexion</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
{{-- This view is used to inform the user that a password reset link has been sent to their email address. --}}
{{-- It includes a success message and a button to return to the login page. --}}
{{-- The layout is styled using Bootstrap for a clean and modern look. --}}
{{-- The card component is used to display the message in a centered box on the page. --}}