<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Tailwind CSS compilé -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100 font-inter">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg overflow-hidden animate__animated animate__fadeInDown">
            <!-- Header illustration -->
            <div class="bg-indigo-600 p-6 text-center">
                <h2 class="text-2xl font-bold text-white">Créer un compte</h2>
                <p class="text-indigo-100 text-sm">Créer un SuperAdmin</p>
            </div>

            <!-- Formulaire -->
            <div class="p-6">
                <form method="POST" action="">
                    @csrf

                    <!-- Nom -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nom complet')" />
                        <x-text-input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                      type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Adresse email')" />
                        <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                      type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Mot de passe')" />
                        <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                      type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                                      type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Boutons -->
                    <div class="flex items-center justify-between">
                        <a class="text-sm text-gray-600 hover:text-indigo-600 underline" href="{{ route('login') }}">
                            Déjà inscrit ?
                        </a>

                        <x-primary-button class="ml-4">
                            {{ __('S\'inscrire') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
