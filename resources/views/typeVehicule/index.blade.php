@extends('layouts.base')
@section('title', 'Type de véhicule')
@section('content')
@if (session('success'))
    <div class="alert m-4 alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert  m-4 alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning m-4 alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
<script>
    setTimeout(() => {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach((alert) => {
            // Démarre l'effet de disparition Bootstrap
            alert.classList.remove('show');
            alert.classList.add('fade');
            // Supprime l'élément du DOM après la transition
            setTimeout(() => alert.remove(), 500); // temps pour l'animation fade
        });
    }, 3000); // 5000ms = 5 secondes
    </script>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header">
                        <div class="bg-gradient-white shadow-white  border-radius-lg pt-4 pb-3 px-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-dark text-capitalize m-0">Types de Véhicules</h6>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="material-symbols-rounded me-1">add</i> Nouveau type de véhicule
                        </button>
                            </div>
                        </div>
                    </div>
                {{-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-light border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                        <h6 class="text-dark text-capitalize m-0">Types de Véhicules</h6>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="material-symbols-rounded me-1">add</i> Ajouter un type
                        </button>
                    </div>
                </div> --}}
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">N°</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Type de véhicule</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Kilo initial</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Kilo final</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Tarification</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Date création</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($typeVehicules as $typeVehicule)
                                <tr>
                                    <td class="ps-3 align-middle">
                                        <span class="text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                    </td>

                                    <td class="ps-3 align-middle">
                                        <span class="text-xs font-weight-bold">{{ $typeVehicule->nom_type }}</span>
                                    </td>

                                    <td class="text-center align-middle">
                                        <span class="text-xs font-weight-bold">{{ $typeVehicule->kilo_initiale }}</span>
                                    </td>

                                    <td class="text-center align-middle">
                                        <span class="text-xs font-weight-bold">{{ $typeVehicule->kilo_final }}</span>
                                    </td>

                                    <td class="text-center align-middle">
                                        <span class="text-xs font-weight-bold">{{ $typeVehicule->tarif->kilo_tarif }}kg / ${{ number_format($typeVehicule->tarif->prix_tarif, 2) }}</span>
                                    </td>

                                    <td class="text-center align-middle">
                                        <span class="text-xs font-weight-bold">{{ $typeVehicule->created_at->format('d/m/Y H:i') }}</span>
                                    </td>

                                    <td class="text-center align-middle">
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="openTypeVehiculeModal(
                                            {{ $typeVehicule->id }},
                                            '{{ $typeVehicule->nom_type }}',
                                            {{ $typeVehicule->kilo_initiale }},
                                            {{ $typeVehicule->kilo_final }},
                                            {{ $typeVehicule->tarif->id }})">
                                            <i class="material-symbols-rounded text-sm">edit</i>
                                        </button>
                                        <form action="{{ route('typeVehicule.destroy', $typeVehicule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="material-symbols-rounded text-sm">delete</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <span class="text-xs font-weight-bold">Aucun type de véhicule trouvé</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Structure -->
<div class="modal fade" id="typeVehiculeModal" tabindex="-1" aria-labelledby="typeVehiculeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="typeVehiculeModalLabel">Modification du type de véhicule</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <form id="typeVehiculeForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="type_vehicule_id" name="id">

            <div class="mb-3">
                <label for="modal_nomTypeVehicule" class="form-label">Nom du type de véhicule</label>
                <input type="text" class="form-control border border-secondary" id="modal_nomTypeVehicule"
                       name="nom_type" placeholder="Ex: Camion, Moto, etc." required>
            </div>

            <div class="mb-3">
                <label for="modal_kilo_initiale" class="form-label">Kilo initial</label>
                <input type="number" class="form-control border border-secondary" id="modal_kilo_initiale"
                       name="kilo_initiale" placeholder="Ex: 1, 2, 3" required>
            </div>

            <div class="mb-3">
                <label for="modal_kilo_final" class="form-label">Kilo final</label>
                <input type="number" class="form-control border border-secondary" id="modal_kilo_final"
                       name="kilo_final" placeholder="Ex: 2, 3, 10" required>
            </div>

            <div class="mb-3">
                <label for="modal_tarif_id" class="form-label">Tarif</label>
                <select name="tarif_id" id="modal_tarif_id" class="form-select border border-secondary" required>
                    <option value="">Sélectionnez un tarif</option>
                    @foreach($tarifs as $tarif)
                        <option value="{{ $tarif->id }}" data-display="{{ $tarif->kilo_tarif }} kilo / ${{ $tarif->prix_tarif }}">
                            {{ $tarif->kilo_tarif }} kilo / ${{ $tarif->prix_tarif }}
                        </option>
                    @endforeach
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

<script>
// Fonction pour ouvrir et pré-remplir le modal
function openTypeVehiculeModal(id, nomType, kiloInit, kiloFinal, tarifId) {
    // Remplir les champs du formulaire
    document.getElementById('type_vehicule_id').value = id;
    document.getElementById('modal_nomTypeVehicule').value = nomType;
    document.getElementById('modal_kilo_initiale').value = kiloInit;
    document.getElementById('modal_kilo_final').value = kiloFinal;

    // Sélectionner le bon tarif
    const select = document.getElementById('modal_tarif_id');
    if (select) {
        select.value = tarifId;
    }

    // Mettre à jour l'action du formulaire
    document.getElementById('typeVehiculeForm').action = `typevehicule/${id}`;

    // Ouvrir le modal
    var modal = new bootstrap.Modal(document.getElementById('typeVehiculeModal'));
    modal.show();
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Tooltips si nécessaire
    [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        .forEach(function(el) {
            new bootstrap.Tooltip(el);
        });
});
</script>

  <!-- Modal -->
  @include('typeVehicule.create')
@endsection




