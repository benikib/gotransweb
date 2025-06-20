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
                                        {{-- <a class="btn btn-link btn-sm ms-auto text-dark px-1 mb-0"
                                           data-bs-toggle="tooltip" href="{{ route('typeVehicule.edit', $type->id) }}"
                                           data-bs-placement="top" title="Modifier">
                                            <i class="material-symbols-rounded text-lg">edit</i>
                                        </a> --}}

                                        <button class="btn btn-link btn-sm ms-auto text-dark px-1 mb-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editTypeVehiculeModal"
                                                data-bs-toggle="tooltip" title="Modifier"
                                                onclick="openTypeVehiculeModal({{ $type->id }}, '{{ $type->nom_type }}', '{{ $type->kilo_initiale }}', '{{ $type->kilo_final }}', {{ $type->tarif_id }})">
                                                <i class="material-symbols-rounded text-lg">edit</i>
                                        </button>

                                    </div>
                                    <div class="mt-auto pt-2">
                                        <div class="d-flex justify-content-between border-bottom py-1">
                                            <span class="text-xs">Tarif initial:</span>
                                            <span class="text-xs font-weight-bold">{{ $type->kilo_initiale ?? 1 }} Kilo</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom py-1">
                                            <span class="text-xs">Tarif final:</span>
                                            <span class="text-xs font-weight-bold">{{ $type->kilo_final ?? 1 }} Kilo</span>
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
                            <div class="card border border-light shadow-xs p-3 h-100 hover-scale transition-all">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-gradient-warning text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                        {{ strtoupper(substr($client->user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-sm">{{ $client->user->name }}</h6>
                                        <p class="text-xs text-muted mb-0">{{ $client->user->email }}</p>
                                    </div>
                                                                            <button
  class="btn btn-link text-dark px-2 mb-0"
  data-bs-toggle="modal"
  data-bs-target="#editUserModal"
  data-id="{{ $client->user_id }}"
  data-name="{{ $client->user->name }}"
  data-email="{{ $client->user->email }}"
  data-phone="{{ $client->user->number_phone }}"
  data-url="{{ route('users.update', $client->user_id) }}"
  data-mode="client"
  data-bs-toggle="tooltip"
  onclick="openEditModal(this)"
>
  <i class="material-symbols-rounded text-lg">edit</i>
</button>
                                    {{-- <a href="{{ route('users.edit', $client->user_id) }}" class="text-dark" title="Modifier">
                                        <i class="material-symbols-rounded">edit</i>
                                    </a> --}}
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
                            <div class="card border border-light shadow-xs p-3 h-100 hover-scale transition-all">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-gradient-warning text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                        {{ strtoupper(substr($livreur->user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-sm">{{ $livreur->user->name }}</h6>
                                        <p class="text-xs text-muted mb-0">{{ $livreur->user->email }}</p>
                                    </div>
                                     <button
  class="btn btn-link text-dark px-2 mb-0"
  data-bs-toggle="modal"
  data-bs-target="#editUserModal"
  data-id="{{ $livreur->user_id }}"
  data-name="{{ $livreur->user->name }}"
  data-email="{{ $livreur->user->email }}"
  data-phone="{{ $livreur->user->number_phone }}"
  data-url="{{ route('users.update', $livreur->user_id) }}"
  data-mode="livreur"
  data-bs-toggle="tooltip"
  onclick="openEditModal(this)"
>
  <i class="material-symbols-rounded text-lg">edit</i>
</button>
                                    {{-- <a href="{{ route('users.edit', $livreur->user_id) }}" class="text-dark" title="Modifier">
                                        <i class="material-symbols-rounded">edit</i>
                                    </a> --}}
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
                        <div class="card border border-light shadow-xs p-3 h-100 hover-scale transition-all">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-gradient-warning text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-sm">{{ $vehicule->type_vehicule->nom_type }}</h6>
                                    <p class="text-xs text-muted mb-0">Immat: {{ $vehicule->immatriculation }}</p>
                                </div>
                                <button class="btn btn-link text-dark px-2 mb-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editVehiculeModal"
                                        data-bs-toggle="tooltip" title="Modifier"
                                        onclick="openVehiculeModal(
                                            {{ $vehicule->id }},
                                            '{{ $vehicule->immatriculation }}',
                                            '{{ $vehicule->type_vehicule->id }}',
                                            '{{ $vehicule->etat }}'
                                        )">
                                        <i class="material-symbols-rounded">edit</i>
                                    </button>

                                {{-- <a href="{{ route('vehicule.edit', $vehicule->id) }}" class="text-dark" title="Modifier">
                                    <i class="material-symbols-rounded">edit</i>
                                </a> --}}
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
                                 <button
  class="btn btn-link text-dark px-2 mb-0"
  data-bs-toggle="modal"
  data-bs-target="#editUserModal"
  data-id="{{ $admin->user_id }}"
  data-name="{{ $admin->user->name }}"
  data-email="{{ $admin->user->email }}"
  data-phone="{{ $admin->user->number_phone }}"
  data-url="{{ route('users.update', $admin->user_id) }}"
  data-mode="admin"
  data-bs-toggle="tooltip"
  onclick="openEditModal(this)"
>
  <i class="material-symbols-rounded text-lg">edit</i>
</button>

                                {{-- <a href="{{ route('users.edit', $admin->id) }}" class="text-dark" title="Modifier">
                                    <i class="material-symbols-rounded">edit</i>
                                </a> --}}
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
                                        <!-- Bouton d'édition -->
<button class="btn btn-link text-dark px-2 mb-0"
        data-bs-toggle="modal"
        data-bs-target="#editTarifModal"
        title="Modifier"
        onclick="openEditModals('{{ $tarif->id }}', '{{ $tarif->kilo_tarif }}', '{{ $tarif->prix_tarif }}')">
    <i class="material-symbols-rounded text-lg">edit</i>
</button>

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
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Édite</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($livreur_vehicules as $lv)
                            <tr>
                                <td class="ps-2">{{ $lv->livreur->user->email }}</td>
                                <td class="ps-2">{{ $lv->vehicule->type_vehicule->nom_type }}</td>
                                <td class="ps-2">{{ $lv->vehicule->immatriculation }}</td>
                                <td class="ps-2">
                                    <button
                                        class="btn btn-link text-dark px-2 mb-0"
                                        title="Modifier"
                                        onclick="openVehiculeLivreurModal({{ $lv->id }}, {{ $lv->vehicule->id }}, {{ $lv->livreur->id }})"
                                        data-bs-toggle="tooltip"
                                    >
                                        <i class="material-symbols-rounded text-lg">edit</i>
                                    </button>

                                    <!-- Modal -->
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

                                                        <div class="mb-3">
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

                                                        <div class="mb-3">
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


<!-- Modal d'édition Tarif -->
<div class="modal fade" id="editTarifModal" tabindex="-1" aria-labelledby="editTarifModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="editTarifModalLabel">Modification du tarif</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <form id="tarifForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="tarif_id" name="id">
            <div class="mb-3">
                <label for="nomtarif" class="form-label">Kilo de tarification</label>
                <input type="number" class="form-control" id="kilo_tarif" name="kilo_tarif"
                       placeholder="Ex: 1, 2, 3" style="border: 1px solid #000;" required>
            </div>

            <div class="mb-3">
                <label for="tarif" class="form-label">Prix du Tarif</label>
                <input type="number" class="form-control" id="prix_tarif" name="prix_tarif"
                       placeholder="Ex: 2, 3, 10" style="border: 1px solid #000;" required>
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


<!-- Modal user -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title" id="editUserModalLabel">Modifier un utilisateur</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <form id="updateUserForm" method="POST">
          @csrf
          @method('PUT')
           <!-- CHAMP MODE -->
        <input type="hidden" name="m" id="modeField">
          <div class="mb-3">
            <label for="firstname" class="form-label fw-bold">Nom</label>
            <input type="text" class="form-control" name="name" id="firstname" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label fw-bold">Téléphone</label>
            <input type="tel" class="form-control" name="number_phone" id="phone">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label fw-bold">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary rounded-3">Enregistrer</button>
          </div>
        </form>

        <div id="successMessage" class="alert alert-success mt-3 d-none"></div>
      </div>
    </div>
  </div>
</div>
{{-- Modale type vehicile --}}
<div class="modal fade" id="editTypeVehiculeModal" tabindex="-1" aria-labelledby="editTypeVehiculeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Modifier le type de véhicule</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      <form id="editVehiculeForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <div class="mb-3">
            <label for="nomTypeVehicule" class="form-label">Nom du type de véhicule</label>
            <input type="text" class="form-control" id="nomTypeVehicule" name="nom_type">
          </div>

          <div class="mb-3">
            <label for="kiloInitiale" class="form-label">Tarif Kilo initial</label>
            <input type="number" class="form-control" id="kiloInitiale" name="kilo_initiale">
          </div>

          <div class="mb-3">
            <label for="kiloFinal" class="form-label">Tarif Kilo final</label>
            <input type="number" class="form-control" id="kiloFinal" name="kilo_final">
          </div>

          <div class="mb-3">
            <label for="tarifId" class="form-label">Type du tarif</label>
            <select name="tarif_id" id="tarifId" class="form-select">
              @foreach($tarifs as $tarif)
                <option value="{{ $tarif->id }}">{{ $tarif->kilo_tarif }} kilo / $ {{ $tarif->prix_tarif }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Valider</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal vehicul -->
<div class="modal fade" id="editVehiculeModal" tabindex="-1" aria-labelledby="editVehiculeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="editVehiculeModalLabel">Modifier un véhicule</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <form id="editVehiculeForms" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="immatriculation" class="form-label">Numéro d'immatriculation</label>
            <input type="text" class="form-control" id="immatriculation" name="immatriculation" required>
          </div>

          <div class="mb-3">
            <label for="type_vehicule_id" class="form-label">véhicule</label>
            <select name="type_vehicule_id" id="type_vehicule_id" class="form-select">
              <option selected disabled>-- Sélectionnez --</option>
              @foreach($typeVehicules as $typeVehicule)
                <option value="{{ $typeVehicule->id }}">{{ $typeVehicule->nom_type }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="etat" class="form-label">État du véhicule</label>
            <select name="etat" id="etat" class="form-select">
              <option value="1">Bon</option>
              <option value="0">Mauvais</option>
            </select>
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

<!-- Modal affectation -->
{{-- <div class="modal fade" id="editVehiculeLivreurModal" tabindex="-1" aria-labelledby="editVehiculeLivreurModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow border-0 rounded-4">

      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title" id="editVehiculeLivreurModalLabel">Modifier l'affectation véhicule / livreur</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      <div class="modal-body bg-white">
        <form id="editVehiculeLivreurForm" method="POST">
          @csrf
          @method('PUT')

          <!-- Sélection du véhicule -->
          <div class="mb-3">
            <label for="vehiculeSelect" class="form-label">Véhicule</label>
            <select name="vehicule_id" id="vehiculeSelect" class="form-select" required>
              <option value="{{ $lv->vehicule->id }}" selected>
                {{ $lv->vehicule->immatriculation }}
              </option>
              @foreach ($vehicules as $vehicule)
                @if ($vehicule->id !== $lv->vehicule->id)
                  <option value="{{ $vehicule->id }}">{{ $vehicule->immatriculation }}</option>
                @endif
              @endforeach
            </select>
          </div>

          <!-- Sélection du livreur -->
          <div class="mb-3">
            <label for="livreurSelect" class="form-label">Livreur</label>
            <select name="livreur_id" id="livreurSelect" class="form-select" required>
              <option value="{{ $lv->livreur->id }}" selected>
                {{ $lv->livreur->user->email }}
              </option>
              @foreach ($livreurs as $livreur)

                  <option value="{{ $livreur->id }}">{{ $livreur->user->email }}</option>

              @endforeach
            </select>
          </div>

          <!-- Boutons -->
          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-success">Valider</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div> --}}
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
{{-- <script>
    function openEditModal(id, kilo_tarif, prix_tarif) {
        // Remplir les champs du formulaire
        document.getElementById('edit_kilo_tarif').value = kilo_tarif;
        document.getElementById('edit_prix_tarif').value = prix_tarif;

        // Modifier l'action du formulaire avec l'URL correcte (Laravel)
        const form = document.getElementById('editTarifForm');
        form.action = `{{ url('tarif') }}/${id}`;
    }

    // Initialiser les tooltips Bootstrap (si utilisés)
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script> --}}
<script>
// Fonction pour ouvrir et pré-remplir le modal
function openEditModals(id, kilo, prix) {
    // Remplir les champs du formulaire
    // alert(id,kilo,prix);
    document.getElementById('tarif_id').value = id;
    document.getElementById('kilo_tarif').value = kilo;
    document.getElementById('prix_tarif').value = prix;

    // Mettre à jour l'action du formulaire
    document.getElementById('tarifForm').action = `tarif/${id}`;

    // Ouvrir le modal
    // var modal = new bootstrap.Modal(document.getElementById('editTarifModal'));
    // modal.show();
}

// Initialisation des tooltips (si vous en avez)
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

<script>
  function openEditModal(button) {
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');
    const email = button.getAttribute('data-email');
    const phone = button.getAttribute('data-phone');
    const url = button.getAttribute('data-url');
    const mode = button.getAttribute('data-mode');

    // Remplir les champs du formulaire
    document.getElementById('firstname').value = name;
    document.getElementById('email').value = email;
    document.getElementById('phone').value = phone;
    document.getElementById('password').value = "";

    // Mettre à jour l'URL du formulaire
    const form = document.getElementById('updateUserForm');
    form.action = url;

    // Remplir ou créer le champ caché "m"
    const modeField = document.getElementById('modeField');
    modeField.value = mode;
  }
</script>

<script>
  function openTypeVehiculeModal(id, nom_type, kilo_initiale, kilo_final, tarif_id) {
    // Remplir les champs
    document.getElementById('nomTypeVehicule').value = nom_type;
    document.getElementById('kiloInitiale').value = kilo_initiale;
    document.getElementById('kiloFinal').value = kilo_final;
    document.getElementById('tarifId').value = tarif_id;

    // Modifier dynamiquement l'action du formulaire
    const form = document.getElementById('editVehiculeForm');
    form.action = `/typevehicule/${id}`;
  }
</script>
<script>
  function openVehiculeModal(id, immatriculation, typeVehiculeId, etat) {
    // Remplir les champs
    document.getElementById('immatriculation').value = immatriculation;
    document.getElementById('type_vehicule_id').value = typeVehiculeId;
    document.getElementById('etat').value = etat;

    // Mettre à jour l'action du formulaire
    const form = document.getElementById('editVehiculeForms');
    form.action = `vehicule/${id}`; // Assure-toi que cette route PUT existe
  }
</script>
{{-- <script>
  function openVehiculeLivreurModal(livreurVehiculeId, vehiculeId, livreurId) {
    // Préremplissage des champs select
    document.getElementById('vehiculeSelect').value = vehiculeId;
    document.getElementById('livreurSelect').value = livreurId;

    // Mise à jour de l'action du formulaire
    const form = document.getElementById('editVehiculeLivreurForm');
    form.action = `/affectation/${livreurVehiculeId}`; // si ta route est bien RESTful

    // Si besoin, tu peux utiliser route Laravel avec Blade :
    // form.action = "{{ route('livreurVehicule.update', ':id') }}".replace(':id', livreurVehiculeId);
  }
</script> --}}
<script>
  function openVehiculeLivreurModal(id, vehiculeId, livreurId) {
    document.getElementById('vehiculeSelect' + id).value = vehiculeId;
    document.getElementById('livreurSelect' + id).value = livreurId;

    const form = document.getElementById('editVehiculeLivreurForm' + id);
    form.action = `/affectation/${id}`;

    const modal = new bootstrap.Modal(document.getElementById('editVehiculeLivreurModal' + id));
    modal.show();
  }

  // Activation des tooltips Bootstrap
  document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
</script>


@endsection
