<div class="modal fade" id="staticBackdrops" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ajouter tarif</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="{{ route('tarifs.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label for="nomtarif" class="form-label">Kilo de tarification</label>
        <input type="number" class="form-control border border-secondary" id="nomtarif" name="kilo_tarif" placeholder="Ex: 1 , 2, 3">
    </div>

    <div class="mb-3">
        <label for="tarif" class="form-label">Prix du tarif</label>
        <input type="number" class="form-control border border-secondary" id="tarif" name="prix_tarif" placeholder="Ex: 2 , 3 , 10 ">
    </div>

    {{-- Si tu veux relier un type de véhicule au tarif plus tard, tu peux activer ce champ : --}}
    {{--
    <div class="mb-3">
        <label for="typeVehicule" class="form-label">Type de véhicule</label>
        <select name="id_type_vehicule" class="form-select border border-secondary" id="typeVehicule">
            <option selected disabled>Choisir un type</option>
            @forelse ($typeVehicules as $typeVehicule)
                <option value="{{ $typeVehicule->id }}">{{ $typeVehicule->nom_type }}</option>
            @empty
                <option disabled>Aucun type disponible</option>
            @endforelse
        </select>
    </div>
    --}}

    <div class="d-flex justify-content-end gap-2">
       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-success">Valider</button>
    </div>
</form>


        </div>

      </div>
    </div>
  </div>
