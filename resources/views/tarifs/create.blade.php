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
                <label for="nom" class="form-label">Nom du tarif</label>
                <input type="text" class="form-control border border-secondary" id="nom" name="nom" placeholder="Ex: Tarif Standard" required maxlength="255">
            </div>

            <div class="mb-3">
                <label for="kilo_tarif" class="form-label">Kilo</label>
                <input type="number" class="form-control border border-secondary" id="kilo_tarif" name="kilo_tarif" placeholder="Ex: 1 , 2, 3" required>
            </div>

            <div class="mb-3">
                <label for="prix_tarif" class="form-label">Prix du tarif</label>
                <input type="number" class="form-control border border-secondary" id="prix_tarif" name="prix_tarif" placeholder="Ex: 2 , 3 , 10" required>
            </div>

            <div class="d-flex justify-content-end gap-2">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-success">Valider</button>
            </div>
         </form>
        </div>
      </div>
    </div>
</div>
