<x-guest-layout>
    <div class="card shadow p-4 mx-auto mt-5" style="max-width: 500px;">
        <h4 class="mb-4 text-center">🔁 Réinitialiser le mot de passe</h4>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Adresse e-mail')" class="form-label" />
                <x-text-input id="email"
                              type="email"
                              name="email"
                              :value="old('email', $request->email)"
                              required
                              autofocus
                              autocomplete="username"
                              class="form-control" />
                <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-input-label for="password" :value="__('Nouveau mot de passe')" class="form-label" />
                <x-text-input id="password"
                              type="password"
                              name="password"
                              required
                              autocomplete="new-password"
                              class="form-control" />
                <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="form-label" />
                <x-text-input id="password_confirmation"
                              type="password"
                              name="password_confirmation"
                              required
                              autocomplete="new-password"
                              class="form-control" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-1" />
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <x-primary-button class="btn btn-primary">
                    {{ __('Réinitialiser le mot de passe') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
