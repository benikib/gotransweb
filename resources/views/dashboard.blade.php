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
    'livree'     => 'text-success',
    'en_attente' => 'text-warning',
    'annulee'    => 'text-danger',
    'en_cours'   => 'text-info',
    default      => 'text-success'
};
}
@endphp
@section('title', 'Tableau de bord')
@section('content')
<div class="container-fluid py-4">

    <!-- Page Header with Breadcrumb -->

<div class="row g-4 mb-4">

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


    <!-- Stats Cards - Improved layout and colors -->
    <div class="row g-4 mb-4">
        <!-- Clients -->
        <div class="col-xl-4 col-sm-6">
            <div class="card card-custom font-weight-bolder h-100 text-center py-4">
                <a href="{{ route('users.index', ['m' => 'client']) }}" style="text-decoration: none; color: inherit;">
                    <div class="card-body">
                    <p class="card-title">Clients enregistrés</p>
                    <div class="card-value">{{ $client }}</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Véhicules -->
        <div class="col-xl-4 col-sm-6">
            <div class="card card-custom font-weight-bolder h-100 text-center py-4">
                <a href="{{ route('vehicule.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card-body">
                    <p class="card-title">Véhicules enregistrés</p>
                    <div class="card-value">{{ count($vehicules) }}</div>
                </div>
                </a>

            </div>
        </div>

        <!-- Livreurs -->
        <div class="col-xl-4 col-sm-6">
            <div class="card card-custom h-100 text-center py-4">
                <a href="{{ route('users.index', ['m' => 'livreur']) }}" style="text-decoration: none; color: inherit;">
                    <div class="card-body">
                    <p class="card-title">Livreurs enregistrés</p>
                    <div class="card-value">{{ count($livreurs) }}</div>
                    </div>
                </a>
            </div>
        </div>
    </div>




    <!-- Main Content Section -->
<div class="row g-4 mb-4">
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
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Expéditeur </th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2 text-center">Livreur</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2 text-center">Statut</th>

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
                                        <div>
                                            <div class="text-xs text-capitalize small fw-semibold"> {{$livraison->Expediteur->User->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-light text-capitalize fw-semibold text-dark text-sm ">
                                        {{ $livraison->vehicule->type_vehicule->nom_type ?? "N/A" }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="{{ getBadgeClass($livraison->status) }} text-capitalize small fw-bold px-2 py-1 rounded-pill">
                                        {{ $livraison->status }}
                                    </span>
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
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card z-index-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Livraisons</h6>
                <select id="filterType" class="form-select w-auto">
                    <option value="daily">7 derniers jours</option>
                    <option value="monthly">7 derniers mois</option>
                    <option value="yearly">7 dernières années</option>
                </select>
            </div>
            <div class="card-body">
                <canvas id="livraisonChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

     <!-- Charts Section - Improved layout -->

<!-- Chart 3 - Bootstrap Brain Component -->
{{-- <section class="py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
        <div class="card widget-card border-light shadow-sm">
          <div class="card-body p-4">
            <h5 class="card-title widget-card-title mb-3">Revenue Stats</h5>
            <div id="bsb-chart-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> --}}
{{-- @include('livreurVehicule.create') --}}

<!-- Chart JS Scripts -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {
        daily: @json($dayLabels),
        monthly: @json($monthLabels),
        yearly: @json($yearLabels)
    };

    const dataSets = {
        daily: @json($days),
        monthly: @json($months),
        yearly: @json($years)
    };

    const ctx = document.getElementById("livraisonChart").getContext("2d");
    let livraisonChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels.daily,
            datasets: [{
                label: "Livraisons",
                data: dataSets.daily,
                fill: true,
                borderColor: "#4e73df",
                backgroundColor: "rgba(78, 115, 223, 0.1)",
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    document.getElementById('filterType').addEventListener('change', function () {
        const type = this.value;
        livraisonChart.data.labels = labels[type];
        livraisonChart.data.datasets[0].data = dataSets[type];
        livraisonChart.update();
    });
</script>

@endsection


