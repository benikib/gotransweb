<section>
    <header class="mb-4">
        <h2 class="h5 text-dark">
            {{ __('Informations du profil') }}
        </h2>
        <p class="text-muted small">
            {{ __("Modifiez vos informations de compte et votre adresse e-mail.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nom') }}</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="form-control @error('name') is-invalid @enderror"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="form-control @error('email') is-invalid @enderror"
                required
                autocomplete="username"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-muted small">
                        {{ __('Votre adresse e-mail n’est pas vérifiée.') }}
                        <button
                            type="submit"
                            form="send-verification"
                            class="btn btn-link p-0 m-0 align-baseline"
                        >
                            {{ __('Cliquez ici pour renvoyer l’e-mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small fw-semibold mt-2">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-success small mb-0">
                    {{ __('Enregistré.') }}
                </p>
            @endif
        </div>
    </form>
</section>
