@extends('layouts.base')
@section('title', 'Type de véhicule')
@section('content')
@if (session('success'))
    <div class="alert m-4 alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert  m-4 alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning m-4 alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
<div class="container-fluid py-2">
    <div class="row">
      <div class="col-12 ">
        <div class="card my-4 ">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                <h6 class="text-white text-capitalize m-0">Type de Vehicule</h6>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  Ajouter type de vehicule
                </button>
              </div>

          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N°</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type de vehicule</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tarif Kilo initial</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tarif Kilo final</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TTarification</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($typeVehicules as $typeVehicule)
                  <tr>
                    <!-- ID -->
                    <td class="align-middle">
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $typeVehicule->id }}</h6>
                        </div>
                      </div>
                    </td>

                    <!-- Nom du type -->
                    <td class="align-middle">
                      <p class="text-xs font-weight-bold mb-0">{{ $typeVehicule->nom_type }}</p>
                    </td>

                     <!-- Nom du type -->
                     <td class="align-middle">
                        <p class="text-xs font-weight-bold mb-0">{{ $typeVehicule->kilo_initiale }}</p>
                      </td>
                       <!-- Nom du type -->
                     <td class="align-middle">
                        <p class="text-xs font-weight-bold mb-0">{{ $typeVehicule->kilo_final }}</p>
                      </td>
                    <!-- Nom du type -->
                    <td class="align-middle">
                        <p class="text-xs font-weight-bold mb-0">{{ $typeVehicule->tarif->kilo_tarif . 'kilo / $'. $typeVehicule->tarif->prix_tarif }}</p>
                    </td>
                                        <!-- Timestamp -->
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $typeVehicule->created_at->format('d/m/Y H:i') }}
                      </span>
                    </td>
                    

                    <!-- Bouton Edit -->
                    <td class="align-middle text-begin">
                      <a href="{{ route('typeVehicule.edit', $typeVehicule->id) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                        Éditer
                      </a>
                    </td>
                    <td class="align-middle text-start">
                        <form action="{{ route('typeVehicule.destroy', $typeVehicule->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce type de véhicule ?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger text-xs p-0 m-0" style="text-decoration: none;" title="Supprimer">
                                Supprimer
                            </button>
                        </form>
                    </td>

                  </tr>

                  @empty
                    <tr>
                        <td colspan="5" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">Aucun type de véhicule trouvé.</p>
                        </td>
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
  @include('typeVehicule.create')
@endsection




