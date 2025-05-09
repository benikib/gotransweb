
<!-- Modal -->
<div class="modal fade" id="livreurModal" tabindex="-1" aria-labelledby="livreurModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="livreurModalLabel">Modifier un livreur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action ="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="firstname">Nom complete</label>
                    <input type="text" class="form-control"name='name' id="firstname" value="{{old('nom',$use->name)}} "required>
                    
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control " name="email" id="email" em value="{{old('email',$use->email)}}" required>
                  
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone (facultatif)</label>
                    <input type="tel" class="form-control" name="number_phone" id="phone" value="{{old('number_phone',$use->number_phone)}}">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{old('password',$use->password)}}" required>
                </div>

                {{-- <div class="form-group mt-3">
                    <label for="role">Rôle</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="">-- Sélectionnez un rôle --</option>
                        <option value="admin">Admin</option>
                        <option value="client">Client</option>
                        <option value="livreur">Livreur</option>
                    </select>
                </div> --}}



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Enregistre</button>
        </form>
        </div>
      </div>
    </div>
  </div>
