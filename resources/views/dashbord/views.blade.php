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
<div class="container-fluid py-2">
    <div class="row">

        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-12 mb-lg-0 mb-4">

                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                          <div class="row">
                            <div class="col-6 d-flex align-items-center">
                              <h6 class="mb-0">Types de Véhicules</h6>
                            </div>
                            <div class="col-6 text-end">
                              <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="material-symbols-rounded text-sm">add</i>&nbsp;&nbsp;Ajouter un type
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="card-body p-3">
                          <div class="row">
                            @foreach ($typeVehicules as $type)
                              <div class="col-md-4 p-2 mb-md-0 mb-3">
                                <div class="card card-body border card-plain border-radius-lg">
                                  <div class="d-flex align-items-center mb-2">
                                    <i class="material-symbols-rounded me-2 text-primary">directions_car</i>
                                    <h6 class="mb-0">{{ $type->nom_type }}</h6>
                                    <a class="material-symbols-rounded ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"  href="{{ route('typeVehicule.edit', $type->id) }}" data-bs-placement="top" title="Modifier">edit</a>
                                  </div>
                                  <p class="mb-1">Tarif initial : <strong>{{ $type->kilo_initiale * $type->tarif->prix_tarif }} $</strong></p>
                                  <p class="mb-0">Tarif final : <strong>{{ $type->kilo_final * $type->tarif->prix_tarif  }} $</strong></p>
                                  <p class="mb-0">Tarif  : <strong>{{ $type->tarif->prix_tarif }}$ / {{ $type->tarif->kilo_tarif }} kilo </strong></p>
                                </div>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>


                  </div>
                </div>
              </div>
        {{-- livreurs --}}
        <div class="col-lg-4">
            <div class="card h-100">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-2 d-flex align-items-center">
                    <h6 class="mb-0">Livreurs</h6>
                  </div>
                  <div class="col-6 text-end">
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-primary btn-sm mb-0 me-2">Ajouter Livreur</button>

                  </div><div class="col-4 text-end">

                    <button class="btn btn-outline-primary btn-sm mb-0">Voir tout</button>
                  </div>
                </div>
              </div>
              <div class="card-body p-3 pb-0">
                <ul class="list-group">
                  @foreach ($livreurs as $livreur)
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $livreur->user->nom }}</h6>
                        <span class="text-xs">{{ $livreur->user->email }}</span>
                        <span class="text-xs">{{ $livreur->user->number_phone }}</span>
                      </div>
                      <div class="d-flex align-items-center text-sm">
                        <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4">
                          <a  href="{{ route('users.edit', $type->id) }}" class="material-symbols-rounded text-lg position-relative me-1">edit</a>
                        </button>
                      </div>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>

    </div>
    <div class="row">
        {{-- Vehicules --}}
        <div class="col-md-7 mt-4">
            <div class="card">
              <div class="card-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="mb-0">Véhicules</h6>
                  </div>
                  <div class="col-md-6 text-end">
                    <button data-bs-toggle="modal" data-bs-target="#ajoutVehiculeModal" class="btn btn-outline-primary btn-sm mb-0 me-2">
                      Ajouter véhicule
                    </button>
                    <a href="{{ route('vehicule.index') }}" class="btn btn-outline-primary btn-sm mb-0">
                      Voir tout
                    </a>
                  </div>
                </div>
              </div>

              <div class="card-body pt-4 p-3">
                <ul class="list-group">
                  @foreach ($vehicules as $vehicule)
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="mb-3 text-sm">{{ $vehicule->proprietaire }}</h6>
                        <span class="mb-2 text-xs">Couleur : <span class="text-dark font-weight-bold ms-sm-2">{{ $vehicule->couleur }}</span></span>
                        <span class="mb-2 text-xs">Immatriculation : <span class="text-dark ms-sm-2 font-weight-bold">{{ $vehicule->immatriculation }}</span></span>
                        <span class="text-xs">Type : <span class="text-dark ms-sm-2 font-weight-bold">{{ $vehicule->type_vehicule->nom_type }}</span></span>
                      </div>
                      <div class="ms-auto text-end">
                        <a href="{{ route('vehicule.edit', $vehicule->id) }}" class="btn btn-link text-dark px-3 mb-0">
                            <i class="material-symbols-rounded text-sm me-2">edit</i>Modifier
                          </a>

                          <form action="{{ route('vehicule.destroy', $vehicule->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0">
                              <i class="material-symbols-rounded text-sm me-2">delete</i>Supprimer
                            </button>
                          </form>

                      </div>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>

        {{-- admins  --}}
        <div class="col-md-5 mt-4">
            <div class="card h-100 mb-4">
              <div class="card-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-6 d-flex align-items-center">
                    <h6 class="mb-0">Administrateurs</h6>
                  </div>
                  <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-primary btn-sm mb-0 me-2">Ajouter admin</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-dark btn-sm mb-0">Voir tout</a>
                  </div>
                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Nouveaux</h6>
                <ul class="list-group">
                  @foreach ($admins as $admin)
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                      <div class="d-flex align-items-center">
                        <button class="btn btn-icon-only btn-rounded btn-outline-primary mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                          <i class="material-symbols-rounded text-lg">person</i>
                        </button>
                        <div class="d-flex flex-column">
                          <h6 class="mb-1 text-dark text-sm">{{ $admin->user->name }}</h6>
                          <span class="text-xs">{{ $admin->user->email }}</span>
                        </div>
                      </div>
                      <div class="d-flex align-items-center text-sm text-secondary">
                        {{ $admin->created_at->format('d M Y') }}
                      </div>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>




      </div>

  </div>
  @include('users.create')
  @include('typeVehicule.create')
  @include('vehicule.create')
@endsection

