<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Mon compte</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">GoTrans</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="py-5">
        <div class="container">
            <h1 class="mb-4">Mon compte</h1>
            <div class="row g-4">

                <!-- Formulaire de mise à jour des infos -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-semibold">Informations du profil</div>
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Formulaire de changement de mot de passe -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-semibold">Changer le mot de passe</div>
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Formulaire de suppression de compte -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-semibold text-danger">Supprimer mon compte</div>
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Pied de page -->
    <footer class="py-4 bg-white text-center border-top">
        <div class="container">
            <span class="text-muted">&copy; {{ date('Y') }} GoTrans. Tous droits réservés.</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

