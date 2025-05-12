<div class="modal fade" id="modalLivraison" tabindex="-1" aria-labelledby="modalLivraisonLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <!-- En-tête -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalLivraisonLabel">Nouvelle Livraison</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      <!-- Formulaire -->
      <form method="POST" action="{{ route('livraison.store') }}">
        @csrf
        <div class="modal-body">
            <div class="row mb-3">
                <div class="col">
                <label class="form-label">Type vehicule</label>
                <div class="input-group input-group-outline">
                    <select name="" id="type_vehicule" class="form-control" required>
                    </select>
                </div>
                </div>

                <div class="col">
                <label class="form-label">vehicule disponible</label>
                <div class="input-group input-group-outline">
                    <select name="" id="vehicule" class="form-control" required>
                    </select>
                </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                <label class="form-label">Livreur disponible</label>
                <div class="input-group input-group-outline">
                    <select name="" id="livreur" class="form-control" required>
                    </select>
                </div>
                </div>

               
            </div>
        </div>

        <!-- Pied de la modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Affecter</button>
        </div>
      </form>

    </div>
  </div>
</div>

