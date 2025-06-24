@extends('layouts.base')
@section('title', 'Véhicules')
@section('content')
@if (session('success'))
    <div class="alert m-4 alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert m-4 alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert m-4 alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
{{-- Script pour faire disparaître les messages après 5 secondes --}}
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
                    <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                        <h6 class="text-dark text-capitalize m-0">
                            <i class="material-symbols-rounded me-2">directions_car</i> Gestion des Véhicules
                        </h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ajoutVehiculeModal">
                            <i class="material-symbols-rounded me-1">add</i> Nouveau véhicule
                        </button>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-3">
                        <table class="table table-hover align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">#</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Immatriculation</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Type</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">État</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Tarif</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Enregistrement</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vehicules as $vehicule)
                                <tr>
                                    <td class="ps-3 align-middle">
                                        <span class="text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                    </td>

                                    <td class="ps-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            <i class="material-symbols-rounded text-sm me-2">badge</i>
                                            <span class="text-xs font-weight-bold">{{ $vehicule->immatriculation }}</span>
                                        </div>
                                    </td>

                                    <td class="text-center align-middle">
                                        <span class="badge bg-info text-xs font-weight-bold">
                                            {{ $vehicule->type_vehicule->nom_type }}
                                        </span>
                                    </td>

                                    <td class="text-center align-middle">
                                        @if($vehicule->etat)
                                            <span class="badge bg-success text-xs font-weight-bold">
                                                <i class="material-symbols-rounded text-sm me-1">check_circle</i> Bon état
                                            </span>
                                        @else
                                            <span class="badge bg-danger text-xs font-weight-bold">
                                                <i class="material-symbols-rounded text-sm me-1">warning</i> Réparation
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center align-middle">
                                        <span class="text-xs font-weight-bold">
                                            ${{ number_format($vehicule->type_vehicule->tarif->prix_tarif, 2) }} / {{ $vehicule->type_vehicule->tarif->kilo_tarif }}kg
                                        </span>
                                    </td>

                                    <td class="text-center align-middle">
                                        <span class="text-xs font-weight-bold d-block">
                                            {{ $vehicule->created_at->format('d/m/Y') }}
                                        </span>
                                        <span class="text-xs text-muted">
                                            {{ $vehicule->created_at->format('H:i') }}
                                        </span>
                                    </td>

                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-sm btn-outline-primary me-2" title="Modifier"
                                                onclick="openEditVehiculeModal({
                                                id: {{ $vehicule->id }},
                                                immatriculation: '{{ $vehicule->immatriculation }}',
                                                type_vehicule_id: {{ $vehicule->type_vehicule->id }},
                                                etat: {{ $vehicule->etat ? 'true' : 'false' }}
                                                })">
                                                <i class="material-symbols-rounded text-sm">edit</i>
                                                </button>
                                            {{-- <a href="{{ route('vehicule.edit', $vehicule->id) }}" class="btn btn-sm btn-outline-info me-2" title="Modifier">
                                                <i class="material-symbols-rounded text-sm">edit</i>
                                            </a> --}}
                                            <form action="{{ route('vehicule.destroy', $vehicule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce véhicule ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Supprimer">
                                                    <i class="material-symbols-rounded text-sm">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="material-symbols-rounded text-muted mb-2" style="font-size: 48px;">directions_car_off</i>
                                            <span class="text-xs font-weight-bold">Aucun véhicule enregistré</span>
                                        </div>
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


<div class="modal fade" id="editVehiculeModal" tabindex="-1" aria-labelledby="editVehiculeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header text-dark">
        <h5 class="modal-title" id="editVehiculeModalLabel">Modifier le véhicule</h5>
        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editVehiculeForm" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="immatriculation" class="form-label">Numéro d'immatriculation</label>
            <input type="text" class="form-control" id="modalImmatriculation" name="immatriculation" required>
          </div>

          <div class="mb-3">
            <label for="type_vehicule_id" class="form-label">Type du véhicule</label>
            <select name="type_vehicule_id" id="modalTypeVehicule" class="form-select" required>
              @foreach($typeVehicules as $typeVehicule)
                <option value="{{ $typeVehicule->id }}">{{ $typeVehicule->nom_type }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="etat" class="form-label">État du véhicule</label>
            <select name="etat" id="modalEtat" class="form-select" required>
              <option value="1">Bon</option>
              <option value="0">Mauvais</option>
            </select>
          </div>

          <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-success">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// Fonction pour ouvrir le modal avec les données pré-remplies
function openEditVehiculeModal(vehicule) {
  // Remplir les champs du formulaire
  document.getElementById('modalImmatriculation').value = vehicule.immatriculation;
  document.getElementById('modalTypeVehicule').value = vehicule.type_vehicule_id;
  document.getElementById('modalEtat').value = vehicule.etat ? '1' : '0';

  // Mettre à jour l'action du formulaire
  document.getElementById('editVehiculeForm').action = `/vehicule/${vehicule.id}`;

  // Afficher le modal
  const modal = new bootstrap.Modal(document.getElementById('editVehiculeModal'));
  modal.show();
}

// Exemple d'utilisation (à adapter selon votre contexte) :
// Lorsque vous cliquez sur un bouton "Modifier" :
// <button onclick="openEditVehiculeModal({
//   id: {{ $vehicule->id }},
//   immatriculation: '{{ $vehicule->immatriculation }}',
//   type_vehicule_id: {{ $vehicule->type_vehicule->id }},
//   etat: {{ $vehicule->etat ? 'true' : 'false' }}
// })">Modifier</button>
</script>
  <!-- Modal -->
  @include('vehicule.create')
@endsection




