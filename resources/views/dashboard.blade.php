@extends('layouts.base')

@section('title', 'Dashboard')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
@php
function getBadgeClass($status) {
        return 'badge badge-sm ' . match ($status) {
            'livree'    => 'bg-gradient-success',
            'en_attente'  => 'bg-gradient-warning',
            'annulee'   => 'bg-gradient-danger',
            'en_cours'   => 'bg-gradient-info',
        };
    }

@endphp


@section('content')

   <div class="container-fluid py-2">
      <div class="row">
        <div class="ms-3">
  <h3 class="h4 font-weight-bold mb-1">Tableau de bord</h3>
  <p class="text-sm text-muted mb-0">
    Consultez les Livraisons
  </p>
</div>

        
        
       <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
         <div class="card">
            <div class="card-header p-3 pb-2">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <p class="text-sm text-capitalize text-secondary mb-1">Total livraisons</p>
          <h4 class="mb-0">{{ $livraisonsThisWeek }}</h4>
        </div>
        <div class="icon icon-md icon-shape bg-gradient-dark shadow text-center border-radius-lg">
          <i class="material-symbols-rounded text-white">local_shipping</i>
        </div>
    </div>

    <hr class="horizontal dark my-0">

    <div class="card-footer p-3">
      <p class="mb-0 text-sm">
        <span class="text-{{ $livraisonsPourcentage >= 0 ? 'success' : 'danger' }} font-weight-bold">
          {{ $livraisonsPourcentage >= 0 ? '+' : '' }}{{ $livraisonsPourcentage }}%
        </span>
         à la semaine dernière
      </p>
    </div>
  </div>
        </div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <div class="card">
    <div class="card-header p-3 pb-2">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <p class="text-sm text-capitalize text-secondary mb-1">Utilisateurs aujourd'hui</p>
          <h4 class="mb-0">{{ $usersToday }}</h4>
        </div>
        <div class="icon icon-md icon-shape bg-gradient-dark shadow text-center border-radius-lg">
          <i class="material-symbols-rounded text-white">person</i>
        </div>
      </div>
    </div>

    <hr class="horizontal dark my-0">

    <div class="card-footer p-3">
      <p class="mb-0 text-sm">
        <span class="text-{{ $usersPourcentage >= 0 ? 'success' : 'danger' }} font-weight-bold">
          {{ $usersPourcentage >= 0 ? '+' : '' }}{{ $usersPourcentage }}%
        </span>
        par rapport à hier
      </p>
    </div>
  </div>
</div>

<!-- Total Véhicules -->
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <div class="card">
    <div class="card-header p-2 ps-3">
      <div class="d-flex justify-content-between">
        <div>
          <p class="text-sm mb-0 text-capitalize">Véhicules</p>
          <h4 class="mb-0">{{ count($vehicules) }}</h4>
        </div>
        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
          <i class="material-symbols-rounded opacity-10">leaderboard</i>
        </div>
      </div>
    </div>
    <hr class="dark horizontal my-0">
    <div class="card-footer p-2 ps-3">
      <p class="mb-0 text-sm">
        <span class="text-danger font-weight-bolder">-2%</span>
        par rapport à hier
      </p>
    </div>
  </div>
</div>

<!-- Total Types de Véhicule -->
<div class="col-xl-3 col-sm-6">
  <div class="card">
    <div class="card-header p-2 ps-3">
      <div class="d-flex justify-content-between">
        <div>
          <p class="text-sm mb-0 text-capitalize">Types de véhicule</p>
          <h4 class="mb-0">{{ count($typeVehicules) }}</h4>
        </div>
        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
          <i class="material-symbols-rounded opacity-10">weekend</i>
        </div>
      </div>
    </div>
    <hr class="dark horizontal my-0">
    <div class="card-footer p-2 ps-3">
      <p class="mb-0 text-sm">
        <span class="text-success font-weight-bolder">+5%</span>
        par rapport à hier
      </p>
    </div>
  </div>
</div>


        {{-- statistique --}}
     <div class="row">
  {{-- Carte 1 : Livraisons cette semaine --}}
  <div class="col-lg-4 col-md-6 mt-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-0">Livraisons cette semaine</h6>
        <p class="text-sm">Comparé à la semaine dernière</p>
        <div class="pe-2">
          <div class="chart">
            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
          </div>
        </div>
        <hr class="dark horizontal">
        <div class="d-flex">
          <i class="material-symbols-rounded text-sm my-auto me-1">trending_up</i>
          <p class="mb-0 text-sm">
            <span class="font-weight-bolder">
              {{ $livraisonsPourcentage >= 0 ? '+' : '' }}{{ $livraisonsPourcentage }}%
            </span> par rapport à la semaine dernière
          </p>
        </div>
      </div>
    </div>
  </div>

  {{-- Carte 2 : Utilisateurs aujourd’hui --}}
  <div class="col-lg-4 col-md-6 mt-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-0">Utilisateurs aujourd’hui</h6>
        <p class="text-sm">
          (<span class="font-weight-bolder">
            {{ $usersPourcentage >= 0 ? '+' : '' }}{{ $usersPourcentage }}%
          </span>) comparé à hier
        </p>
        <div class="pe-2">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
          </div>
        </div>
        <hr class="dark horizontal">
        <div class="d-flex">
          <i class="material-symbols-rounded text-sm my-auto me-1">person</i>
          <p class="mb-0 text-sm">Aujourd’hui : {{ $usersToday }} utilisateur(s)</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Carte 3 : Affectations Livreurs --}}
  <div class="col-lg-4 mt-4 mb-3">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-0">Livreurs affectés</h6>
        <p class="text-sm">Nombre total d'affectations</p>
        <div class="pe-2">
          <div class="chart">
            <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
          </div>
        </div>
        <hr class="dark horizontal">
        <div class="d-flex">
          <i class="material-symbols-rounded text-sm my-auto me-1">local_shipping</i>
          <p class="mb-0 text-sm">Total : {{ count($livreur_vehicules) }} affectation(s)</p>
        </div>
      </div>
    </div>
  </div>
</div>

      {{-- fonctionnalite --}}

      <div class="row mb-4 p-3">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Livraison recentes </h6>
                  <p class="text-sm mb-0">
                    {{-- <i class="fa fa-check text-info" aria-hidden="true"></i> --}}
                    {{-- <span class="font-weight-bold ms-1">30 done</span> this month --}}
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">code de livraison</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Exp et Dest</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type de Vehicule</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    </tr>
                  </thead>
                  
                    <tbody>
                    @forelse ($livraisons as $livraison)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $livraison->code }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="avatar-group mt-2">
                          
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                            <img src="../assets/img/team-3.jpg" alt="team3">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                            <img src="../assets/img/team-4.jpg" alt="team4">
                          </a>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">
                          {{ $livraison->vehicule->type_vehicule->nom_type ?? "N/A" }}
                        </span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="badge badge-sm {{ getBadgeClass($livraison->status) }}">{{$livraison->status}}</span>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="4" class="text-center">Aucune livraison récente</td>
                    </tr>
                    @endforelse
                  
                  </tbody>
                    
                  
                  
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
  <h6 class="mb-0">Affectation Véhicule</h6>
  
  <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Affecter
  </a>
</div>

            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
           <!-- Bouton "Affecter un véhicule" -->


<!-- Liste des livreurs affectés à des véhicules -->
@forelse ($livreur_vehicules as $lv)
  <div class="timeline-block mb-3 d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <span class="timeline-step me-3">
        <i class="material-symbols-rounded text-success text-gradient">person</i>
      </span>
      <div class="timeline-content">
<h6 class="text-dark text-sm font-weight-bold mb-0">
  {{ $lv->livreur->user->name }}
</h6>
<p class="text-secondary font-weight-bold text-xs mt-1 mb-0"> type véhicule 
  {{ $lv->vehicule->type_vehicule->nom_type }} 
  {{ $lv->vehicule->immatriculation }}
</p>


      </div>
    </div>
    
    <!-- Icône d'édition -->
    <a href="{{ route('livreurVehicule.edit', $lv->id) }}" class="text-secondary">
      <i class="material-symbols-rounded">edit</i>
    </a>
  </div>
@empty
  <div class="timeline-block mb-3">
    <span class="timeline-step">
      <i class="material-symbols-rounded text-danger text-gradient">person</i>
    </span>
    <div class="timeline-content">
      <h6 class="text-dark text-sm font-weight-bold mb-0">Aucun livreur affecté</h6>
    </div>
  </div>
@endforelse

            
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
 </div>
 @include('livreurVehicule.create')

@endsection




