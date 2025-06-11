@extends('layouts.base')
@section('title', 'Tableau de bord')
@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="material-symbols-rounded me-2">check_circle</i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="material-symbols-rounded me-2">error</i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="material-symbols-rounded me-2">warning</i>
            <div>{{ session('warning') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Fermer"></button>
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
        <!-- Header with Stats -->
        <div class="row  mb-4"> <!-- Marge top ici pour éviter que ce soit trop haut -->
        <div class="col-12">
            <div class="card card-body shadow-sm border-0">
                <div class="row align-items-center">
                    <!-- Titre à gauche -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h5 class="mb-1">Tableau de bord</h5>
                        <p class="mb-0 text-sm text-muted">Gestion des véhicules, livreurs et administrateurs</p>
                    </div>

                    <!-- Navigation à droite -->
                    {{-- <div class="col-md-6 text-md-end">
                        <div class="nav-wrapper d-inline-block">
                            <ul class="nav nav-pills p-1 bg-light rounded shadow-sm" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-vehicules" role="tab">
                                        <i class="material-symbols-rounded text-sm me-1">directions_car</i> Véhicules
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tab-livreurs" role="tab">
                                        <i class="material-symbols-rounded text-sm me-1">local_shipping</i> Livreurs
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-3 pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Types de Véhicules</h6>
                        <div>
                            <button type="button" class="btn btn-sm bg-gradient-dark mb-0 me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="material-symbols-rounded text-sm">add</i>&nbsp;Ajouter
                            </button>
                            <a href="{{ route('typeVehicule.index') }}" class="btn btn-sm btn-outline-dark mb-0">
                                <i class="material-symbols-rounded text-sm">list</i>&nbsp;Tout voir
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-3">
                    <div class="row">
                        @forelse ($typeVehicules as $type)
                            <div class="col-md-4 p-2 mb-md-0 mb-3">
                                <div class="card card-body border card-plain border-radius-lg d-flex flex-column h-100 hover-scale transition-all">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm icon-shape bg-gradient-warning shadow text-center rounded-circle me-2">
                                            <i class="material-symbols-rounded text-white opacity-10">directions_car</i>
                                        </div>
                                        <h6 class="mb-0">{{ $type->nom_type }}</h6>
                                        <a class="btn btn-link btn-sm ms-auto text-dark px-1 mb-0"
                                           data-bs-toggle="tooltip" href="{{ route('typeVehicule.edit', $type->id) }}"
                                           data-bs-placement="top" title="Modifier">
                                            <i class="material-symbols-rounded text-lg">edit</i>
                                        </a>
                                    </div>
                                    <div class="mt-auto pt-2">
                                        <div class="d-flex justify-content-between border-bottom py-1">
                                            <span class="text-xs">Tarif initial:</span>
                                            <span class="text-xs font-weight-bold">{{ $type->kilo_initiale * $type->tarif->prix_tarif ?? 1 }} $</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom py-1">
                                            <span class="text-xs">Tarif final:</span>
                                            <span class="text-xs font-weight-bold">{{ $type->kilo_final * $type->tarif->prix_tarif ?? 1 }} $</span>
                                        </div>
                                        <div class="d-flex justify-content-between pt-1">
                                            <span class="text-xs">Tarif/kilo:</span>
                                            <span class="text-xs font-weight-bold">{{ $type->tarif->prix_tarif ?? 1 }}$ / {{ $type->tarif->kilo_tarif }}km</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4">
                                <i class="material-symbols-rounded text-secondary opacity-10" style="font-size: 3rem">directions_car_off</i>
                                <p class="text-sm text-secondary mt-2">Aucun type de véhicule enregistré</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="row mt-4">
    {{-- Section Clients --}}
    <div class="col-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header p-3 pb-2 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-dark">Liste des Clients</h6>
                    <div>
                        <button type="button" class="btn btn-sm bg-gradient-dark me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="material-symbols-rounded text-sm">add</i> Ajouter
                        </button>
                        <a href="{{ route('users.index', ['m' => 'client']) }}" class="btn btn-sm btn-outline-dark">
                            <i class="material-symbols-rounded text-sm">list</i> Voir tous
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    @forelse ($clients as $client)
                        <div class="col-md-4 mb-3">
                            <div class="card border border-light shadow-xs p-3 h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-gradient-warning text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                        {{ strtoupper(substr($client->user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-sm">{{ $client->user->name }}</h6>
                                        <p class="text-xs text-muted mb-0">{{ $client->user->email }}</p>
                                    </div>
                                    <a href="{{ route('users.edit', $client->user_id) }}" class="text-dark" title="Modifier">
                                        <i class="material-symbols-rounded">edit</i>
                                    </a>
                                </div>
                                <div class="border-top pt-2 mt-auto">
                                    <p class="text-xs mb-0"><strong>Téléphone :</strong> {{ $client->user->number_phone }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4">
                            <i class="material-symbols-rounded text-secondary opacity-10" style="font-size: 3rem">person_off</i>
                            <p class="text-sm text-muted mt-2">Aucun client enregistré</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Section Livreurs --}}
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header p-3 pb-2 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-dark">Liste des Livreurs</h6>
                    <div>
                        <button type="button" class="btn btn-sm bg-gradient-dark me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="material-symbols-rounded text-sm">add</i> Ajouter
                        </button>
                        <a href="{{ route('users.index', ['m' => 'livreur']) }}" class="btn btn-sm btn-outline-dark">
                            <i class="material-symbols-rounded text-sm">list</i> Voir tous
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    @forelse ($livreurs as $livreur)
                        <div class="col-md-4 mb-3">
                            <div class="card border border-light shadow-xs p-3 h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-gradient-warning text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                        {{ strtoupper(substr($livreur->user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-sm">{{ $livreur->user->name }}</h6>
                                        <p class="text-xs text-muted mb-0">{{ $livreur->user->email }}</p>
                                    </div>
                                    <a href="{{ route('users.edit', $livreur->user_id) }}" class="text-dark" title="Modifier">
                                        <i class="material-symbols-rounded">edit</i>
                                    </a>
                                </div>
                                <div class="border-top pt-2 mt-auto">
                                    <p class="text-xs mb-0"><strong>Téléphone :</strong> {{ $livreur->user->number_phone }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4">
                            <i class="material-symbols-rounded text-secondary opacity-10" style="font-size: 3rem">person_off</i>
                            <p class="text-sm text-muted mt-2">Aucun livreur enregistré</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>








<div class="row mt-4 gap-4">
    <!-- Véhicules -->
    <div class="col-12">
    <div class="card shadow-sm">
        <div class="card-header p-3 pb-2 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-dark">Liste des Véhicules</h6>
                <div>
                    <button type="button" class="btn btn-sm bg-gradient-dark me-2" data-bs-toggle="modal" data-bs-target="#ajoutVehiculeModal">
                        <i class="material-symbols-rounded text-sm">add</i> Ajouter
                    </button>
                    <a href="{{ route('vehicule.index') }}" class="btn btn-sm btn-outline-dark">
                        <i class="material-symbols-rounded text-sm">list</i> Voir tous
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="row">
                @forelse ($vehicules as $vehicule)
                    <div class="col-md-4 mb-3">
                        <div class="card border border-light shadow-xs p-3 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-gradient-warning text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-sm">{{ $vehicule->type_vehicule->nom_type }}</h6>
                                    <p class="text-xs text-muted mb-0">Immat: {{ $vehicule->immatriculation }}</p>
                                </div>
                                <a href="{{ route('vehicule.edit', $vehicule->id) }}" class="text-dark" title="Modifier">
                                    <i class="material-symbols-rounded">edit</i>
                                </a>
                            </div>
                            <div class="border-top pt-2 mt-auto d-flex justify-content-between align-items-center">
                                <span class="text-xs">
                                    <strong>État :</strong>
                                    <span class="badge text-{{ $vehicule->etat ? 'success' : 'danger' }}">
                                        {{ $vehicule->etat ? 'Bon' : 'Mauvais' }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <i class="material-symbols-rounded text-secondary opacity-10" style="font-size: 3rem">car_crash</i>
                        <p class="text-sm text-muted mt-2">Aucun véhicule enregistré</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


    <!-- Administrateurs -->
    <div class="col-12">
    <div class="card shadow-sm">
        <div class="card-header p-3 pb-2 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-dark">Liste des Administrateurs</h6>
                <div>
                    <button type="button" class="btn btn-sm bg-gradient-dark me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="material-symbols-rounded text-sm">add</i> Ajouter
                    </button>
                    <a href="{{ route('users.index', ['m' => 'admin']) }}" class="btn btn-sm btn-outline-dark">
                        <i class="material-symbols-rounded text-sm">list</i> Voir tous
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="row">
                @forelse ($admins as $admin)
                    <div class="col-md-4 mb-3">
                        <div class="card border border-light shadow-xs p-3 h-100 hover-scale transition-all">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-gradient-warning text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                    {{ strtoupper(substr($admin->user->name, 0, 1)) }}
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-sm">{{ $admin->user->name }}</h6>
                                    <p class="text-xs text-muted mb-0">{{ $admin->user->email }}</p>
                                </div>
                                <a href="{{ route('users.edit', $admin->id) }}" class="text-dark" title="Modifier">
                                    <i class="material-symbols-rounded">edit</i>
                                </a>
                            </div>
                            <div class="border-top pt-2 mt-auto">
                                <p class="text-xs mb-0">
                                    <strong>Ajouté le :</strong>
                                    {{ $admin->created_at->format('d M Y') }}
                                </p>
                                <span class="badge badge-sm text-success">Admin</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <i class="material-symbols-rounded text-secondary opacity-10" style="font-size: 3rem">admin_panel_settings</i>
                        <p class="text-sm text-muted mt-2">Aucun administrateur enregistré</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

</div>

</div>


<div class="row mt-4">
    <!-- Tarifs -->
    <div class="col-md-6 d-flex">
        <div class="card shadow-sm flex-fill">
            <div class="card-header p-3 pb-2 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-dark">Liste des Tarifs</h6>
                    <div>
                        <button class="btn btn-sm bg-gradient-dark me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrops">
                            <i class="material-symbols-rounded text-sm">add</i> Ajouter
                        </button>
                        <a href="{{ route('tarifs.index') }}" class="btn btn-sm btn-outline-dark">
                            <i class="material-symbols-rounded text-sm">list</i> Tout voir
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-3 pt-0">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Tarif Kilo</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Prix Unité</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Edite</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tarifs as $tarif)
                                <tr class="hover-scale transition-all bg-white border-bottom">
                                    <td class="ps-3">
                                        <h6 class="mb-0 text-sm">{{ $tarif->kilo_tarif }} kg</h6>
                                    </td>
                                    <td class="ps-3">
                                        <h6 class="mb-0 text-sm">{{ number_format($tarif->prix_tarif, 2, ',', ' ') }} $</h6>
                                    </td>
                                    <td class="ps-3 text-start">
                                        <a href="{{ route('tarifs.edit', $tarif->id) }}" class="btn btn-link text-dark px-2 mb-0" data-bs-toggle="tooltip" title="Modifier">
                                            <i class="material-symbols-rounded text-lg">edit</i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <i class="material-symbols-rounded text-secondary opacity-10" style="font-size: 3rem">local_shipping</i>
                                        <p class="text-sm text-muted mt-2">Aucun tarif enregistré</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Affectations véhicules -->
    <div class="col-md-6 d-flex">
        <div class="card shadow-sm flex-fill">
            <div class="card-header p-3 pb-2 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-dark">Affectations Véhicules</h6>
                    <div>
                        <button class="btn btn-sm bg-gradient-dark me-2" data-bs-toggle="modal" data-bs-target="#staticBack">
                            <i class="material-symbols-rounded">add</i> Affecter
                        </button>
                        <a href="{{ route('livreurVehicule.index') }}" class="btn btn-sm btn-outline-dark">
                            <i class="material-symbols-rounded text-sm">list</i> Tout voir
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Livreur</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Type de Véhicule</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Immatriculation</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Edite</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($livreur_vehicules as $lv)
                                <tr class="hover-scale transition-all bg-white border-bottom">
                                    <td class="ps-3">
                                        <h6 class="mb-0 text-sm font-weight-bold">{{ $lv->livreur->user->name ?? "Inconnu" }}</h6>
                                    </td>
                                    <td class="ps-3">
                                        <h6 class="mb-0 text-sm">{{ $lv->vehicule->type_vehicule->nom_type ?? "A/N" }}</h6>
                                    </td>
                                    <td class="ps-3">
                                        <h6 class="mb-0 text-sm">{{ $lv->vehicule->immatriculation ?? "A/N" }}</h6>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('livreurVehicule.edit', $lv->id) }}" class="btn btn-link text-dark px-2 mb-0" data-bs-toggle="tooltip" title="Modifier">
                                            <i class="material-symbols-rounded text-lg">edit</i>
                                        </a>
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



   <!-- Modal -->
    @include('tarifs.create')
    @include('users.create')
    @include('typeVehicule.create')
    @include('vehicule.create')
    @include('livreurVehicule.create')


    <style>
        .hover-scale {
            transition: all 0.2s ease;
        }
        .hover-scale:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.1);
        }
        .page-header {
            background-size: cover;
            background-position: center center;
        }
        .avatar-initial {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }
        .border-radius-lg {
            border-radius: 0.75rem;
        }
        .card-plain {
            background-color: transparent;
            background-image: none;
            box-shadow: none;
        }
    </style>

    <script>
        // Activer les tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>

@endsection
