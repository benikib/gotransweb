<section>
    <header class="mb-4">
        <h2 class="h5 text-dark">
            {{ __('Modifier le mot de passe') }}
        </h2>
        <p class="text-muted small">
            {{ __('Assurez-vous d’utiliser un mot de passe long et aléatoire pour sécuriser votre compte.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Mot de passe actuel') }}</label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif"
                autocomplete="current-password"
            >
            @if($errors->updatePassword->has('current_password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('Nouveau mot de passe') }}</label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif"
                autocomplete="new-password"
            >
            @if($errors->updatePassword->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-control @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif"
                autocomplete="new-password"
            >
            @if($errors->updatePassword->has('password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-success small mb-0">
                    {{ __('Mot de passe mis à jour.') }}
                </p>
            @endif
        </div>
    </form>
</section>
