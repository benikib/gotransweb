<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ajouter Type vehicule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
           <form action="{{ route('typeVehicule.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="nomTypeVehicule" class="form-label">Nom du type de véhicule</label>
        <input type="text" class="form-control border border-secondary" id="nomTypeVehicule" name="nom_type" placeholder="Ex: Camion, Moto, etc.">
    </div>

    <div class="mb-3">
        <label for="nomtarif" class="form-label">Kilo initial</label>
        <input type="number" class="form-control border border-secondary" id="nomtarif" name="kilo_initiale" placeholder="Ex: 1 , 2, 3">
    </div>

    <div class="mb-3">
        <label for="tarif" class="form-label">Kilo final</label>
        <input type="number" class="form-control border border-secondary" id="tarif" name="kilo_final" placeholder="Ex: 2 , 3 , 10 ">
    </div>

    <div class="mb-3">
        <label for="nomModeleVehicule" class="form-label">Type du véhicule</label>
        <select name="tarif_id" class="form-select border border-secondary" aria-label="Default select example">
            <option selected>Selectionner un tarif</option>
            @forelse ($tarifs as $tarif)
                <option value="{{ $tarif->id }}">
                    {{ $tarif->kilo_tarif . ' kilo / $' . $tarif->prix_tarif }}
                </option>
            @empty
                <option disabled>Aucun tarif disponible</option>
            @endforelse
        </select>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-success">Valider</button>
    </div>
</form>


        </div>

      </div>
    </div>
  </div>
