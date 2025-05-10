@extends('layouts.base')
@section('title', 'Affectation des véhicules')
@section('content')
@if (session('success'))
    <div class="alert  m-4 alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class=" m-4 alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert m-4 alert-warning alert-dismissible fade show" role="alert">
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
                <h6 class="text-white text-capitalize m-0">Affectation du Vehicule aux livreurs</h6>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  Affecter un véhicule
                </button>
              </div>

          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N°</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email du livreur</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">immatriculation du Vehicule</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date </th>

                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($livreurVehicules as $livreurVehicule)
                  <tr>
                    <!-- ID -->
                    <td class="align-middle">
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $livreurVehicule->id }}</h6>
                        </div>
                      </div>
                    </td>


                    <td class="align-middle">
                      <p class="text-xs font-weight-bold mb-0">{{ $livreurVehicule->livreur->user->email }}</p>
                    </td>

                    <td class="align-middle">
                        <p class="text-xs font-weight-bold mb-0">{{ $livreurVehicule->vehicule->immatriculation }}</p>
                      </td>


                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $livreurVehicule->created_at->format('d/m/Y H:i') }}
                      </span>
                    </td>

                    <!-- Bouton Edit -->
                    <td class="align-middle text-begin">
                      <a href="{{ route('livreurVehicule.edit', $livreurVehicule->id) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                        Éditer
                      </a>


                        <form action="{{ route('livreurVehicule.destroy', $livreurVehicule->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce type de véhicule ?');" style="display:inline;">
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
                        <p class="text-xs font-weight-bold mb-0">Aucune affectation effecter.</p>
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
  @include('livreurVehicule.create')
@endsection




