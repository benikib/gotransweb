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

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4 shadow-sm">

                {{-- En-tête blanche --}}
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center px-4 py-3">
                    <h6 class="text-dark text-capitalize m-0">Affectation du véhicule aux livreurs</h6>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBack">
                        Affecter un véhicule
                    </button>
                </div>

                {{-- Tableau --}}
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-light">
                                <tr class="text-center">
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-3">Livreur</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Type de Véhicule</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Immatriculation</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Éditer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($livreurVehicules as $lv)
                                    <tr class="text-center align-middle">
                                        <td class="ps-3">{{ $lv->livreur->user->email }}</td>
                                        <td>{{ $lv->vehicule->type_vehicule->nom_type }}</td>
                                        <td>{{ $lv->vehicule->immatriculation }}</td>
                                        <td>
                                            <button 
                                                class="btn btn-link text-dark px-2 mb-0" 
                                                title="Modifier"
                                                onclick="openVehiculeLivreurModal({{ $lv->id }}, {{ $lv->vehicule->id }}, {{ $lv->livreur->id }})"
                                                data-bs-toggle="tooltip"
                                            >
                                                <i class="material-symbols-rounded text-lg">edit</i>
                                            </button>

                                            {{-- Modal d'édition --}}
                                            <div class="modal fade" id="editVehiculeLivreurModal{{ $lv->id }}" tabindex="-1" aria-labelledby="editVehiculeLivreurModalLabel{{ $lv->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content shadow border-0 rounded-4">

                                                        <div class="modal-header bg-primary text-white rounded-top-4">
                                                            <h5 class="modal-title" id="editVehiculeLivreurModalLabel{{ $lv->id }}">
                                                                Modifier l'affectation véhicule / livreur
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                        </div>

                                                        <div class="modal-body bg-white">
                                                            <form id="editVehiculeLivreurForm{{ $lv->id }}" method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="mb-3 text-start">
                                                                    <label for="vehiculeSelect{{ $lv->id }}" class="form-label">Véhicule</label>
                                                                    <select name="vehicule_id" id="vehiculeSelect{{ $lv->id }}" class="form-select" required>
                                                                        <option value="{{ $lv->vehicule->id }}" selected>{{ $lv->vehicule->immatriculation }}</option>
                                                                        @foreach ($vehicules as $vehicule)
                                                                            @if ($vehicule->id !== $lv->vehicule->id)
                                                                                <option value="{{ $vehicule->id }}">{{ $vehicule->immatriculation }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3 text-start">
                                                                    <label for="livreurSelect{{ $lv->id }}" class="form-label">Livreur</label>
                                                                    <select name="livreur_id" id="livreurSelect{{ $lv->id }}" class="form-select" required>
                                                                        <option value="{{ $lv->livreur->id }}" selected>{{ $lv->livreur->user->email }}</option>
                                                                        @foreach ($livreurs as $livreur)
                                                                            @if ($livreur->id !== $lv->livreur->id)
                                                                                <option value="{{ $livreur->id }}">{{ $livreur->user->email }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="d-flex justify-content-between">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-success">Valider</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <i class="material-symbols-rounded text-secondary" style="font-size: 3rem">group_off</i>
                                            <p class="text-sm text-secondary mt-2">Aucune affectation enregistrée</p>
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
