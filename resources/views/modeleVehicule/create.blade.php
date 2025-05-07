<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ajouter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('modeleVehicule.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="nomModeleVehicule" class="form-label">Nom du Modele de véhicule</label>
                  <input type="text" class="form-control" id="nomModeleVehicule" name="nom_modele" placeholder="Ex: spriter.">
                </div>
                <label for="tarif" class="form-label">Tarif</label>
                <input type="number" class="form-control" id="tarif" name="tarif" placeholder="Ex: 2000">
                {{-- <label for="nomTypeVehicule" class="form-label">Nom du Modele de véhicule</label> --}}
                {{-- <select  name="id_type_vehicule"class="form-select" aria-label="Default select example" >
                    <option  selected >Open this select menu</option>
                    @forelse ($typeVehicules as $typeVehicule )
                    <option  value={{ $typeVehicule->id}} name="id_type_vehicule"> {{ $typeVehicule->nom_type }}</option>
                    @empty

                    @endforelse


                  </select> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Valider</button>
                  </div>
              </form>

        </div>

      </div>
    </div>
  </div>
