<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ajouter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('livreurVehicule.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="nomModeleVehicule" class="form-label input-group input-group-outline"> Véhicule</label>
                  <select  name="vehicule_id"class="form-select" aria-label="Default select example" >
                    <option  selected >Open this select menu</option>
                    @forelse ($vehicules as $vehicule )
                    <option  value={{ $vehicule->id}} > {{ $vehicule->immatriculation }}</option>
                    @empty

                    @endforelse


                  </select>
                </div>

                <label for="nomTypeVehicule" class="form-label">Livreur</label>
                <select  name="livreur_id"class="form-select" aria-label="Default select example" >
                    <option  selected >Open this select menu</option>
                    @forelse ($livreurs as $livreur )
                    <option  value={{ $livreur->id}} > {{ $livreur->user->email }}</option>
                    @empty

                    @endforelse


                  </select>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Valider</button>
                  </div>
              </form>

        </div>

      </div>
    </div>
  </div>
