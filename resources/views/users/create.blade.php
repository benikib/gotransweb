<!-- Modal  user -->
@php
$users = null;
$valeur = $_GET['m'] ?? null;

if($valeur === 'admin'){
 $users = "admin"; 
}
if($valeur === 'livreur'){
 $users = "livreur"; 
}
if($valeur === 'client'){
 $users = "client"; 
}
@endphp


<div class="modal fade" id="exampleModalr" tabindex="-1" aria-labelledby="exampleModalLabelr" aria-hidden="true">
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
            <input type="hidden" name="role" id="role" value="{{ $users }}">

            {{-- <select class="form-select rounded-3" name="role" id="role" required>
              <option value="">-- Sélectionnez un rôle --</option>
              <option value="admin">Admin</option>
              <option value="client">Client</option>
              <option value="livreur">Livreur</option>
              
            </select> --}}
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

{{--             zehfgsdhgfhjdjjckds --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <div class="modal-header text-dark rounded-top-4">
        <h5 class="modal-title" id="editUserModalLabel">Créer un nouveau j {{ $users }}</h5>
        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <form  action="{{ route('users.store') }}"  method="POST">
          @csrf
           <!-- CHAMP MODE -->
        {{-- <input type="hidden" name="m" id="modeField"> --}}
          <div class="mb-3">
            <label for="firstname" class="form-label fw-bold">Nom</label>
            <input type="text" class="form-control" name="name" id="firstname" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label fw-bold">Téléphone</label>
            <input type="tel" class="form-control" name="number_phone" id="phone">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label fw-bold">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <input type="hidden" name="role" id="role" value="{{ $users }}">
          {{-- <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary rounded-3">Enregistrer</button>
          </div> --}}
          <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-success">Valider</button>
            </div>
        </form>

        <div id="successMessage" class="alert alert-success mt-3 d-none"></div>
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
