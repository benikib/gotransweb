<section class="mb-5">
    <header class="mb-4">
        <h2 class="h5 text-danger">
            {{ __('Supprimer le compte') }}
        </h2>
        <p class="text-muted small">
            {{ __('Une fois votre compte supprimé, toutes ses données seront définitivement perdues. Veuillez sauvegarder vos données avant la suppression.') }}
        </p>
    </header>

    <!-- Bouton pour déclencher le modal -->
    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        {{ __('Supprimer le compte') }}
    </button>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">{{ __('Confirmer la suppression') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            {{ __('Une fois votre compte supprimé, toutes ses données seront définitivement perdues. Veuillez entrer votre mot de passe pour confirmer la suppression.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label visually-hidden">{{ __('Mot de passe') }}</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif"
                                placeholder="{{ __('Mot de passe') }}"
                                required
                            >
                            @if($errors->userDeletion->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Supprimer le compte') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
