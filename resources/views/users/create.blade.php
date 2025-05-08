<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Creer un livreur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action ="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control"name='name' id="firstname" placeholder="Entrez votre prénom" required>
                    
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control " name="email" id="email" em placeholder="Entrez votre email" required>
                  
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone (facultatif)</label>
                    <input type="tel" class="form-control" name="number_phone" id="phone" placeholder="Entrez votre numéro de téléphone">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                </div>

                <div class="form-group mt-3">
                    <label for="role">Rôle</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="">-- Sélectionnez un rôle --</option>
                        <option value="admin">Admin</option>
                        <option value="client">Client</option>
                        <option value="livreur">Livreur</option>
                    </select>
                </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Enregistre</button>
        </form>
        </div>
      </div>
    </div>
  </div>
