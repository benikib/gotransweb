@extends('layouts.base')
@section('title', 'Véhicules')
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
<div class="container-fluid py-2">
    <div class="row">
      <div class="col-12 ">
        <div class="card my-4 ">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                <h6 class="text-white text-capitalize m-0">Vehicule</h6>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  Ajouter Vehicule
                </button>
              </div>

          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N°</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Immatriculation</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Modele</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tarif</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($vehicules as $vehicule)
                  <tr>
                    <!-- ID -->
                    <td class="align-middle">
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $vehicule->id }}</h6>
                        </div>
                      </div>
                    </td>

                    <!-- Nom du type -->
                    <td class="align-middle ">
                      <p class="text-xs font-weight-bold mb-0">{{ $vehicule->immatriculation }}</p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $vehicule->modele_vehicule->nom_modele }}
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $vehicule->type_vehicule->nom_type }}
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $vehicule->tarif }}
                      </span>
                    </td>
                    <!-- Timestamp -->
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $vehicule->created_at->format('d/m/Y H:i') }}
                      </span>
                    </td>

                    <!-- Bouton Edit -->
                    <td class="align-middle text-begin">
                      <a href="{{ route('vehicule.edit', $vehicule->id) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                        Éditer
                      </a>
                    </td>
                    <td class="align-middle text-start">
                        <form action="{{ route('vehicule.destroy', $vehicule->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce  véhicule ?');" style="display:inline;">
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
                        <p class="text-xs font-weight-bold mb-0">Aucun  véhicule trouvé.</p>
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
  @include('vehicule.create')
@endsection




