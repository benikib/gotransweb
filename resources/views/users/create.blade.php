<!-- Modal  user -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- Plus large pour un meilleur affichage -->
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Créer un utilisateur</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4 py-4">
        <form action="{{ route('users.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="firstname" class="form-label fw-bold">Prénom</label>
            <input type="text" class="form-control rounded-3" name="name" id="firstname" placeholder="Entrez votre prénom" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control rounded-3" name="email" id="email" placeholder="Entrez votre email" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label fw-bold">Téléphone (facultatif)</label>
            <input type="tel" class="form-control rounded-3" name="number_phone" id="phone" placeholder="Entrez votre numéro de téléphone">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label fw-bold">Mot de passe</label>
            <input type="password" class="form-control rounded-3" name="password" id="password" placeholder="Entrez votre mot de passe" required>
          </div>

          <div class="mb-4">
            <label for="role" class="form-label fw-bold">Rôle</label>
            <select class="form-select rounded-3" name="role" id="role" required>
              <option value="">-- Sélectionnez un rôle --</option>
              <option value="admin">Admin</option>
              <option value="client">Client</option>
              <option value="livreur">Livreur</option>
            </select>
          </div>

          <div class="modal-footer px-0">
            <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary rounded-3">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
 <style>
  .form-control, select.form-select {
  border: 1px solid #000; /* bordure noire 1px */
  border-radius: 4px; /* coins légèrement arrondis */
}

</style>
