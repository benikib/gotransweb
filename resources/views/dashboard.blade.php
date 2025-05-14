@extends('layouts.base')

<!-- Alert Messages - Improved spacing and icons -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="material-symbols-rounded me-2">check_circle</i>
        {{ session('success') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="material-symbols-rounded me-2">error</i>
        {{ session('error') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="material-symbols-rounded me-2">warning</i>
        {{ session('warning') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif

@php
function getBadgeClass($status) {
    return 'badge badge-sm ' . match ($status) {
        'livree'    => 'bg-gradient-success',
        'en_attente'  => 'bg-gradient-warning',
        'annulee'   => 'bg-gradient-danger',
        'en_cours'   => 'bg-gradient-info',
        default     => 'bg-gradient-secondary'
    };
}
@endphp
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid py-4">
    <!-- Page Header with Breadcrumb -->

    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header min-height-300 border-radius-xl" style="background-image: url('https://images.unsplash.com/photo-1531403009284-440f080d1e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');>
                <span class="mask bg-gradient-dark opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">Tableau de bord</h3>
                        <p class="text-sm text-muted mb-0">
                            Statistiques et gestion des livraisons
                        </p>
                    </div>
                    <div>

                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-primary">
    <i class="material-symbols-rounded">refresh</i> Actualiser
</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards - Improved layout and colors -->
    <div class="row g-4 mb-4">
        <!-- Total Livraisons -->
        <div class="col-xl-3 col-sm-6">
            <div class="card card-stats h-100">
                <div class="card-header p-3 pt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-symbols-rounded text-white">local_shipping</i>
                        </div>
                        <div class="text-end pt-1 ms-auto">
                            <p class="text-sm mb-0 text-capitalize">Livraisons cette semaine</p>
                            <h4 class="mb-0">{{ $livraisonsThisWeek }}</h4>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-sm">
                        <span class="text-{{ $livraisonsPourcentage >= 0 ? 'success' : 'danger' }} font-weight-bold">
                            <i class="material-symbols-rounded text-xs">trending_{{ $livraisonsPourcentage >= 0 ? 'up' : 'down' }}</i>
                            {{ $livraisonsPourcentage >= 0 ? '+' : '' }}{{ $livraisonsPourcentage }}%
                        </span>
                        vs semaine dernière
                    </p>
                </div>
            </div>
        </div>

        <!-- Utilisateurs aujourd'hui -->
        <div class="col-xl-3 col-sm-6">
            <div class="card card-stats h-100">
                <div class="card-header p-3 pt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-symbols-rounded text-white">person</i>
                        </div>
                        <div class="text-end pt-1 ms-auto">
                            <p class="text-sm mb-0 text-capitalize">Utilisateurs aujourd'hui</p>
                            <h4 class="mb-0">{{ $usersToday }}</h4>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-sm">
                        <span class="text-{{ $usersPourcentage >= 0 ? 'success' : 'danger' }} font-weight-bold">
                            <i class="material-symbols-rounded text-xs">trending_{{ $usersPourcentage >= 0 ? 'up' : 'down' }}</i>
                            {{ $usersPourcentage >= 0 ? '+' : '' }}{{ $usersPourcentage }}%
                        </span>
                        vs hier
                    </p>
                </div>
            </div>
        </div>

        <!-- Véhicules -->
        <div class="col-xl-3 col-sm-6">
            <div class="card card-stats h-100">
                <div class="card-header p-3 pt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="icon icon-lg icon-shape bg-gradient-warning shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-symbols-rounded text-white">directions_car</i>
                        </div>
                        <div class="text-end pt-1 ms-auto">
                            <p class="text-sm mb-0 text-capitalize">Véhicules</p>
                            <h4 class="mb-0">{{ count($vehicules) }}</h4>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-sm">
                        <span class="text-danger font-weight-bold">
                            <i class="material-symbols-rounded text-xs">trending_down</i>
                            2%
                        </span>
                        vs hier
                    </p>
                </div>
            </div>
        </div>

        <!-- Types de Véhicule -->
        <div class="col-xl-3 col-sm-6">
            <div class="card card-stats h-100">
                <div class="card-header p-3 pt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-symbols-rounded text-white">category</i>
                        </div>
                        <div class="text-end pt-1 ms-auto">
                            <p class="text-sm mb-0 text-capitalize">Types de véhicule</p>
                            <h4 class="mb-0">{{ count($typeVehicules) }}</h4>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0 text-sm">
                        <span class="text-success font-weight-bold">
                            <i class="material-symbols-rounded text-xs">trending_up</i>
                            5%
                        </span>
                        vs hier
                    </p>
                </div>
            </div>
        </div>
    </div>



    <!-- Main Content Section -->
    <div class="row g-4">
        <!-- Livraisons récentes -->
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header p-3 pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Livraisons récentes</h6>
                        <div>
                           <a href="{{ route('livraison.index') }}" class="btn btn-sm btn-outline-primary">
                         <i class="material-symbols-rounded">list_alt</i> Voir tout
                                </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Code</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Expéditeur/Destinataire</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center">Véhicule</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center">Statut</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($livraisons as $livraison)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm font-weight-bold">{{ $livraison->code }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $livraison->created_at->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-group me-3">
                                                <a href="#" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $livraison->expedition->tel_expedition }}">
                                                    <img src="../assets/img/team-3.jpg" alt="expediteur">
                                                </a>
                                                <a href="#" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $livraison->destinataire }}">
                                                    <img src="../assets/img/team-4.jpg" alt="destinataire">
                                                </a>
                                            </div>
                                            <div>
                                                <p class="text-xs font-weight-bold mb-0">Exp: {{ Str::limit($livraison->expedition->tel_expedition, 10) }}</p>
                                                <p class="text-xs text-secondary mb-0">Dest: {{ Str::limit($livraison->destination->tel_destination, 10) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-xs font-weight-bold">
                                            {{ $livraison->vehicule->type_vehicule->nom_type ?? "N/A" }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="{{ getBadgeClass($livraison->status) }} text-uppercase text-xs font-weight-bold">
                                            {{ $livraison->status }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-end">
                                        <button class="btn btn-sm btn-outline-info mb-0 px-2 py-1">
                                            <i class="material-symbols-rounded text-sm">visibility</i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="material-symbols-rounded text-secondary">inbox</i>
                                        <p class="text-sm text-secondary mt-2">Aucune livraison récente</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top py-2">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm justify-content-end mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Suivant</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Affectations véhicules -->
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header p-3 pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Affectations véhicules</h6>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="material-symbols-rounded">add</i> Affecter
                        </button>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="list-group list-group-flush">
                        @forelse ($livreur_vehicules as $lv)
                        <div class="list-group-item border-0 px-0 py-2">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-sm icon-shape bg-gradient-info shadow text-center rounded-circle me-3">
                                    <i class="material-symbols-rounded text-white text-sm">person</i>
                                </div>
                                <div class="d-flex flex-column flex-grow-1">
                                    <h6 class="mb-1 text-sm font-weight-bold">{{ $lv->livreur->user->name }}</h6>
                                    <div class="d-flex align-items-center">
                                        <span class="text-xs me-2"><i class="material-symbols-rounded text-xs">directions_car</i> {{ $lv->vehicule->type_vehicule->nom_type ?? "A/N" }}</span>
                                        <span class="text-xs"><i class="material-symbols-rounded text-xs">badge</i> {{ $lv->vehicule->immatriculation }}</span>
                                    </div>
                                </div>
                                <div class="ms-auto text-end">
                                    <a href="{{ route('livreurVehicule.edit', $lv->id) }}" class="btn btn-sm btn-outline-secondary mb-0 px-2 py-1">
                                        <i class="material-symbols-rounded text-sm">edit</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="material-symbols-rounded text-secondary">group_off</i>
                            <p class="text-sm text-secondary mt-2">Aucune affectation enregistrée</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top py-2">
                    <div class="text-center">
                        <a href="{{ route('livreurVehicule.index') }}" class="text-sm font-weight-bold">
                            <i class="material-symbols-rounded text-sm">list</i> Voir toutes les affectations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Charts Section - Improved layout -->
    <div class="row g-4 mb-4 p-3">
        <!-- Livraisons cette semaine -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header p-3 pb-2">
                    <h6 class="mb-0">Livraisons cette semaine</h6>
                    <p class="text-sm mb-0 text-secondary">Comparé à la semaine dernière</p>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas" height="200"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <div class="d-flex align-items-center">
                        <i class="material-symbols-rounded text-sm me-1 text-{{ $livraisonsPourcentage >= 0 ? 'success' : 'danger' }}">trending_{{ $livraisonsPourcentage >= 0 ? 'up' : 'down' }}</i>
                        <p class="mb-0 text-sm">
                            <span class="font-weight-bolder">{{ $livraisonsPourcentage >= 0 ? '+' : '' }}{{ $livraisonsPourcentage }}%</span>
                            par rapport à la semaine dernière
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Utilisateurs aujourd'hui -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header p-3 pb-2">
                    <h6 class="mb-0">Activité des utilisateurs</h6>
                    <p class="text-sm mb-0 text-secondary">Évolution sur 7 jours</p>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="200"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <div class="d-flex align-items-center">
                        <i class="material-symbols-rounded text-sm me-1 text-{{ $usersPourcentage >= 0 ? 'success' : 'danger' }}">trending_{{ $usersPourcentage >= 0 ? 'up' : 'down' }}</i>
                        <p class="mb-0 text-sm">
                            <span class="font-weight-bolder">{{ $usersPourcentage >= 0 ? '+' : '' }}{{ $usersPourcentage }}%</span>
                            par rapport à hier
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Affectations Livreurs -->
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header p-3 pb-2">
                    <h6 class="mb-0">Affectations livreurs</h6>
                    <p class="text-sm mb-0 text-secondary">Répartition par type de véhicule</p>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="chart">
                        <canvas id="chart-line-tasks" class="chart-canvas" height="200"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <div class="d-flex align-items-center">
                        <i class="material-symbols-rounded text-sm me-1">local_shipping</i>
                        <p class="mb-0 text-sm">
                            Total: <span class="font-weight-bolder">{{ count($livreur_vehicules) }}</span> affectations
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('livreurVehicule.create')

<!-- Chart JS Scripts -->
<script>
    // Bar chart
    var ctx1 = document.getElementById("chart-bars").getContext("2d");
    new Chart(ctx1, {
        type: "bar",
        data: {
            labels: ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
            datasets: [{
                label: "Livraisons",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#3A416F",
                data: [50, 40, 60, 30, 70, 20, 90],
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        padding: 10,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });

    // Line chart
    var ctx2 = document.getElementById("chart-line").getContext("2d");
    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
            datasets: [{
                label: "Utilisateurs",
                tension: 0,
                pointRadius: 5,
                pointBackgroundColor: "#e91e63",
                pointBorderColor: "transparent",
                borderColor: "#e91e63",
                borderWidth: 4,
                backgroundColor: "transparent",
                fill: true,
                data: [50, 40, 60, 30, 70, 20, 90],
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        padding: 10,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });

    // Pie chart
    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");
    new Chart(ctx3, {
        type: "doughnut",
        data: {
            labels: ["Camions", "Voitures", "Motos"],
            datasets: [{
                label: "Affectations",
                weight: 9,
                cutout: "60%",
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: ["#3A416F", "#e91e63", "#4CAF50"],
                data: [15, 20, 10],
                fill: false
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            },
            cutout: '70%',
        },
    });
</script>

@endsection


