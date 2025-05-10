<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center">

    <div class="absolute top-5 right-5">
        <button onclick="document.documentElement.classList.toggle('dark')" class="bg-gray-300 dark:bg-gray-800 text-black dark:text-white px-4 py-2 rounded shadow">
            🌗 Thème
        </button>
    </div>

    <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-gray-100">Connexion</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse Email</label>
                <input id="email" name="email" type="email" required autofocus class="w-full px-4 py-2 mt-1 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm"/>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe</label>
                <input id="password" name="password" type="password" required class="w-full px-4 py-2 mt-1 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm"/>
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                    <input type="checkbox" name="remember" class="mr-2">
                    Se souvenir de moi
                </label>

                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                Se connecter
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
            Pas encore inscrit ?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline dark:text-blue-400">Créer un compte</a>
        </p>
    </div>

</body>
</html>
