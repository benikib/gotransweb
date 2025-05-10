<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ajouter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('tarifs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="nomtarif" class="form-label">Kilo  du tarification</label>
                  <input type="number" class="form-control" id="nomtarif" name="kilo_tarif" placeholder="Ex: 1 , 2, 3">
                </div>
                <label for="tarif" class="form-label"> prix du Tarif</label>
                <input type="number" class="form-control" id="tarif" name="prix_tarif" placeholder="Ex: 2 , 3 , 10 ">
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
