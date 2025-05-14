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

    <div class="container-fluid py-4">
        <!-- Header with Stats -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header min-height-150 border-radius-xl" style="background-image: url('https://images.unsplash.com/photo-1531403009284-440f080d1e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');">
                    <span class="mask bg-gradient-dark opacity-6"></span>
                    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                        <div class="row gx-4">
                            <div class="col-auto">
                                <div class="avatar avatar-xl position-relative">
                                    <span class="avatar-initial bg-gradient-primary rounded-circle">
                                        <i class="material-symbols-rounded">dashboard</i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">Tableau de bord</h5>
                                    <p class="mb-0 text-sm">Gestion des véhicules, livreurs et administrateurs</p>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                                <div class="nav-wrapper position-relative end-0">
                                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#tab-vehicules" role="tab" aria-selected="true">
                                                <i class="material-symbols-rounded text-sm me-2">directions_car</i>
                                                <span class="ms-1">Véhicules</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#tab-livreurs" role="tab" aria-selected="false">
                                                <i class="material-symbols-rounded text-sm me-2">local_shipping</i>
                                                <span class="ms-1">Livreurs</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Types de Véhicules -->
            <div class="col-lg-8">
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
                                            <div class="icon icon-sm icon-shape bg-gradient-primary shadow text-center rounded-circle me-2">
                                                <i class="material-symbols-rounded text-white opacity-10">directions_car</i>
                                            </div>
                                            <h6 class="mb-0">{{ $type->nom_type }}</h6>
                                            <a class="btn btn-link btn-sm ms-auto text-dark px-1 mb-0"
                                                data-bs-toggle="tooltip" href="{{ route('typeVehicule.edit', $type->id) }}"
                                                data-bs-placement="top" title="Modifier">
                                                <i class="material-symbols-rounded text-sm">edit</i>
                                            </a>
                                        </div>
                                        <div class="mt-auto pt-2">
                                            <div class="d-flex justify-content-between border-bottom py-1">
                                                <span class="text-xs">Tarif initial:</span>
                                                <span class="text-xs font-weight-bold">{{ $type->kilo_initiale * $type->tarif->prix_tarif }} $</span>
                                            </div>
                                            <div class="d-flex justify-content-between border-bottom py-1">
                                                <span class="text-xs">Tarif final:</span>
                                                <span class="text-xs font-weight-bold">{{ $type->kilo_final * $type->tarif->prix_tarif }} $</span>
                                            </div>
                                            <div class="d-flex justify-content-between pt-1">
                                                <span class="text-xs">Tarif/kilo:</span>
                                                <span class="text-xs font-weight-bold">{{ $type->tarif->prix_tarif }}$ / {{ $type->tarif->kilo_tarif }}km</span>
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

            <!-- Livreurs -->
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header p-3 pb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Livreurs</h6>
                            <div>
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="btn btn-sm btn-outline-primary mb-0 me-2">
                                    <i class="material-symbols-rounded text-sm">add</i> Ajouter
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-primary mb-0">
                                    <i class="material-symbols-rounded text-sm">list</i> Tout voir
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pt-0">
                        <ul class="list-group">
                            @forelse ($livreurs as $livreur)
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 hover-scale transition-all">
                                    <div>
                                         <span class="avatar-initial rounded-circle d-inline-flex align-items-center justify-content-center bg-gradient-warning text-white shadow me-3" style="width: 40px; height: 40px;">
                                        <span class="avatar-initial rounded-circle bg-gradient-warning shadow">
                                            {{ substr($livreur->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <h6 class="mb-1 text-sm font-weight-bold">{{ $livreur->user->nom }}</h6>
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge badge-sm bg-gradient-secondary">{{ $livreur->user->email }}</span>
                                            <span class="badge badge-sm bg-gradient-info">{{ $livreur->user->number_phone }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('users.edit', $livreur->id) }}"
                                        class="btn btn-link text-dark text-sm mb-0 px-0">
                                        <i class="material-symbols-rounded text-lg">edit</i>
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item border-0 text-center py-4">
                                    <i class="material-symbols-rounded text-secondary opacity-10" style="font-size: 3rem">person_off</i>
                                    <p class="text-sm text-secondary mt-2">Aucun livreur enregistré</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Véhicules -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-3 pb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Véhicules</h6>
                            <div>
                                <button data-bs-toggle="modal" data-bs-target="#ajoutVehiculeModal"
                                    class="btn btn-sm btn-outline-primary mb-0 me-2">
                                    <i class="material-symbols-rounded text-sm">add</i> Ajouter
                                </button>
                                <a href="{{ route('vehicule.index') }}" class="btn btn-sm btn-outline-primary mb-0">
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
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Type</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Détails</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Etat</th>
                                        <th class="text-end text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($vehicules as $vehicule)
                                        <tr class="hover-scale transition-all">
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                   <div>
  <span class="avatar-initial rounded-circle d-inline-flex align-items-center justify-content-center bg-gradient-dark text-white shadow me-3" style="width: 40px; height: 40px;">
    {{ $loop->iteration }}
  </span>
</div>

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $vehicule->type_vehicule->nom_type }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="text-xs text-secondary">Immat: {{ $vehicule->immatriculation }}</span>
                                                    <span class="text-xs text-secondary">Couleur: {{ $vehicule->couleur }}</span>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
  <span class="badge badge-sm {{ $vehicule->etat ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
    {{ $vehicule->etat ? 'Bon' : 'Mauvais' }}
  </span>
</td>

                                            <td class="align-middle text-end">
                                                <a href="{{ route('vehicule.edit', $vehicule->id) }}" class="btn btn-link text-dark px-2 mb-0" data-bs-toggle="tooltip" title="Modifier">
                                                    <i class="material-symbols-rounded text-sm">edit</i>
                                                </a>
                                                {{-- <form action="{{ route('vehicule.destroy', $vehicule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger px-2 mb-0" data-bs-toggle="tooltip" title="Supprimer">
                                                        <i class="material-symbols-rounded text-sm">delete</i>
                                                    </button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <i class="material-symbols-rounded text-secondary opacity-10" style="font-size: 3rem">car_crash</i>
                                                <p class="text-sm text-secondary mt-2">Aucun véhicule enregistré</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Administrateurs -->
            <div class="col-md-5">
                <div class="card h-100">
                    <div class="card-header p-3 pb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Administrateurs</h6>
                            <div>
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="btn btn-sm btn-outline-primary mb-0 me-2">
                                    <i class="material-symbols-rounded text-sm">add</i> Ajouter
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-dark mb-0">
                                    <i class="material-symbols-rounded text-sm">list</i> Tout voir
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pt-0">
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Nouveaux administrateurs</h6>
                        <ul class="list-group">
                            @forelse ($admins as $admin)
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 hover-scale transition-all">
                                    <div>
                                         <span class="avatar-initial rounded-circle d-inline-flex align-items-center justify-content-center bg-gradient-warning text-white shadow me-3" style="width: 40px; height: 40px;">
                                        <span class="avatar-initial rounded-circle bg-gradient-warning shadow">
                                            {{ substr($admin->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <h6 class="mb-1 text-sm font-weight-bold">{{ $admin->user->name }}</h6>
                                        <span class="text-xs text-secondary">{{ $admin->user->email }}</span>
                                    </div>
                                    <div class="d-flex flex-column text-end">
                                        <span class="text-xs text-secondary">
                                            <i class="material-symbols-rounded text-xs me-1">calendar_today</i>
                                            {{ $admin->created_at->format('d M Y') }}
                                        </span>
                                        <span class="badge badge-sm bg-gradient-success">Admin</span>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item border-0 text-center py-4">
                                    <i class="material-symbols-rounded text-secondary opacity-10" style="font-size: 3rem">admin_panel_settings</i>
                                    <p class="text-sm text-secondary mt-2">Aucun administrateur enregistré</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('users.create')
    @include('typeVehicule.create')
    @include('vehicule.create')

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
