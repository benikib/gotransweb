@extends('layouts.base')
@section('title', 'Affectation des véhicules')

@section('content')

{{-- Alertes avec disparition automatique --}}
@if (session('success'))
    <div class="alert m-4 alert-success alert-dismissible fade show auto-hide-alert" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert m-4 alert-danger alert-dismissible fade show auto-hide-alert" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif

@if (session('warning'))
    <div class="alert m-4 alert-warning alert-dismissible fade show auto-hide-alert" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4 ">
                <!-- En-tête améliorée -->
                <div class="card-header text-dark border-bottom-0 d-flex justify-content-between align-items-center px-4 py-3 rounded-top">
                    <div class="d-flex align-items-center">
                        <i class="material-symbols-rounded me-3">directions_car</i>
                        <h5 class="mb-0">Gestion des Affectations Véhicules-Livreurs</h5>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBack">
                        <i class="material-symbols-rounded me-1">add_circle</i> Nouvelle affectation
                    </button>
                </div>

                <!-- Tableau amélioré -->
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-4">Livreur</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Type Véhicule</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Immatriculation</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center">État</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($livreurVehicules as $lv)
                                    <tr>
                                        <!-- Colonne Livreur -->
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                {{-- <div class="avatar avatar-sm me-3">
                                                    <img src="{{ asset($lv->livreur->user->photo ?? 'assets/img/default-avatar.jpg') }}"
                                                         class="avatar avatar-sm rounded-circle"
                                                         alt="Avatar livreur">
                                                </div> --}}
                                                <div>
                                                    <h6 class="mb-0 text-sm">{{ $lv->livreur->user->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $lv->livreur->user->email }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Colonne Véhicule -->
                                        <td>
                                            <span class="badge bg-info text-xs">{{ $lv->vehicule->type_vehicule->nom_type }}</span>
                                        </td>

                                        <!-- Colonne Immatriculation -->
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="material-symbols-rounded text-sm me-2 text-secondary">badge</i>
                                                <span class="text-sm font-weight-bold">{{ $lv->vehicule->immatriculation }}</span>
                                            </div>
                                        </td>

                                        <!-- Colonne État -->
                                        <td class="text-center">
                                            @if($lv->vehicule->etat)
                                                <span class="badge bg-success text-xs">
                                                    <i class="material-symbols-rounded text-sm me-1">check_circle</i> Opérationnel
                                                </span>
                                            @else
                                                <span class="badge bg-danger text-xs">
                                                    <i class="material-symbols-rounded text-sm me-1">warning</i> En réparation
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Colonne Actions -->
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end">
                                                <!-- Bouton Modifier -->
                                                <button class="btn btn-sm btn-outline-primary me-2"
                                                    onclick="openVehiculeLivreurModal({{ $lv->id }}, {{ $lv->vehicule->id }}, {{ $lv->livreur->id }})"
                                                    data-bs-toggle="tooltip" title="Modifier l'affectation">
                                                    <i class="material-symbols-rounded text-sm">edit</i>
                                                </button>

                                                <!-- Bouton Supprimer -->
                                                <form action="{{ route('livreurVehicule.destroy', $lv->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Supprimer cette affectation ?')"
                                                        data-bs-toggle="tooltip" title="Supprimer l'affectation">
                                                        <i class="material-symbols-rounded text-sm">delete</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal d'édition -->
                                    <div class="modal fade" id="editVehiculeLivreurModal{{ $lv->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Modifier l'affectation</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editVehiculeLivreurForm{{ $lv->id }}" method="POST"
                                                          action="{{ route('livreurVehicule.update', $lv->id) }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="mb-3">
                                                            <label class="form-label">Véhicule</label>
                                                            <select name="vehicule_id" class="form-select" required>
                                                                @foreach ($vehicules as $vehicule)
                                                                    <option value="{{ $vehicule->id }}" {{ $vehicule->id == $lv->vehicule->id ? 'selected' : '' }}>
                                                                        {{ $vehicule->immatriculation }} ({{ $vehicule->type_vehicule->nom_type }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label">Livreur</label>
                                                            <select name="livreur_id" class="form-select" required>
                                                                @foreach ($livreurs as $livreur)
                                                                    <option value="{{ $livreur->id }}" {{ $livreur->id == $lv->livreur->id ? 'selected' : '' }}>
                                                                        {{ $livreur->user->name }} ({{ $livreur->user->email }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="d-flex justify-content-end">
                                                            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="material-symbols-rounded text-muted mb-3" style="font-size: 3rem">assignment_late</i>
                                                <h6 class="text-muted">Aucune affectation enregistrée</h6>
                                                <p class="text-sm text-muted">Cliquez sur "Nouvelle affectation" pour commencer</p>
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

{{-- Script JS --}}
<script>
    function openVehiculeLivreurModal(id, vehiculeId, livreurId) {
        document.getElementById('vehiculeSelect' + id).value = vehiculeId;
        document.getElementById('livreurSelect' + id).value = livreurId;

        const form = document.getElementById('editVehiculeLivreurForm' + id);
        form.action = `/affectation/${id}`;

        const modal = new bootstrap.Modal(document.getElementById('editVehiculeLivreurModal' + id));
        modal.show();
    }

    // Tooltips
    document.addEventListener('DOMContentLoaded', function () {
        const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltips.forEach(function (tooltipEl) {
            new bootstrap.Tooltip(tooltipEl);
        });

        // Auto-hide alerts après 3 secondes
        const alerts = document.querySelectorAll('.auto-hide-alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }, 3000);
        });
    });
</script>

{{-- Modal de création --}}
@include('livreurVehicule.create')

@endsection
