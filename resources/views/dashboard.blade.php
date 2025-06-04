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
@section('title', 'Tableau de bord')
@section('content')
<div class="container-fluid py-4">
    <!-- Page Header with Breadcrumb -->

<div class="row mb-2">
  <div class="col-12">
    <div class="page-header border-radius-xl py-2 bg-light">
      <!-- En-tête simplifié sans image ni masque -->
    </div>
    <div class="card card-body mx-2 mx-md-3 mt-n3">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-1">Tableau de bord</h4>
          <p class="text-sm text-muted mb-0">
            Statistiques et gestion des livraisons
          </p>
        </div>
        <!-- <div>
          <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-primary">
            <i class="material-symbols-rounded">refresh</i> Actualiser
          </a>
        </div> -->
      </div>
    </div>
  </div>
</div>


    <!-- Stats Cards - Improved layout and colors -->
    <div class="row g-4 mb-4">
    <!-- Clients -->
    <div class="col-xl-4 col-sm-6">
        <div class="card card-custom h-100 text-center py-4">
            <div class="card-body">
                <p class="card-title">Clients enregistrés</p>
                <div class="card-value">{{ $client }}</div>
            </div>
        </div>
    </div>

    <!-- Véhicules -->
    <div class="col-xl-4 col-sm-6">
        <div class="card card-custom h-100 text-center py-4">
            <div class="card-body">
                <p class="card-title">Véhicules enregistrés</p>
                <div class="card-value">{{ count($vehicules) }}</div>
            </div>
        </div>
    </div>

    <!-- Livreurs -->
    <div class="col-xl-4 col-sm-6">
        <div class="card card-custom h-100 text-center py-4">
            <div class="card-body">
                <p class="card-title">Livreurs enregistrés</p>
                <div class="card-value">{{ count($livreurs) }}</div>
            </div>
        </div>
    </div>
</div>




    <!-- Main Content Section -->
<div class="row mt-4">
    <!-- Section Livraisons Récentes -->
    <div class="col-md-12 d-flex">
        <div class="card shadow-sm flex-fill">
            <div class="card-header p-3 pb-2 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-dark">Livraisons Récentes</h6>
                    <div>
                        <a href="{{ route('livraison.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="material-symbols-rounded text-sm">list_alt</i> Voir tout
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-3 pt-0">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Code</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Expéditeur / Destinataire</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2 text-center">Véhicule</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2 text-center">Statut</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($livraisons as $livraison)
                            <tr class="hover-scale transition-all bg-white border-bottom">
                                <td class="ps-3 align-middle">
                                    <h6 class="mb-0 text-sm">{{ $livraison->code }}</h6>
                                    <small class="text-muted">{{ $livraison->created_at->format('d/m/Y') }}</small>
                                </td>
                                <td class="ps-3 align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-group me-3">
                                            <img src="../assets/img/team-3.jpg" class="avatar avatar-xs rounded-circle border" data-bs-toggle="tooltip" title="{{ $livraison->expedition->tel_expedition }}">
                                            <img src="../assets/img/team-4.jpg" class="avatar avatar-xs rounded-circle border" data-bs-toggle="tooltip" title="{{ $livraison->destinataire }}">
                                        </div>
                                        <div>
                                            <div class="text-dark small fw-semibold">Exp: {{ Str::limit($livraison->expedition->tel_expedition, 10) }}</div>
                                            <div class="text-muted small">Dest: {{ Str::limit($livraison->destination->tel_destination, 10) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-light text-dark text-sm fw-semibold">
                                        {{ $livraison->vehicule->type_vehicule->nom_type ?? "N/A" }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="{{ getBadgeClass($livraison->status) }} text-uppercase small fw-bold px-2 py-1 rounded-pill">
                                        {{ $livraison->status }}
                                    </span>
                                </td>
                                <td class="text-end align-middle">
                                    <a href="#" class="btn btn-link text-dark px-2 mb-0" title="Voir">
                                        <i class="material-symbols-rounded">visibility</i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="material-symbols-rounded text-secondary opacity-10" style="font-size: 3rem">inbox</i>
                                    <p class="text-sm text-muted mt-2">Aucune livraison récente</p>
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
     setInterval(() => {
    location.reload();
  }, 60000);
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


