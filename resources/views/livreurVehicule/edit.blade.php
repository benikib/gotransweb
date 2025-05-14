@extends('layouts.base')
@section('title', ' véhicule')
@section('content')
<div class="container-fluid p-12 min-vh-100 d-flex justify-content-center align-items-center">
    <div class="modal-body shadow p-4 rounded bg-white">
            <form  class="form-control" action="{{ route('livreurVehicule.update',  $livreurVehicule->id ) }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="nomModeleVehicule" class="form-label"> Véhicule</label>
                  <select  name="vehicule_id"class="form-select -mb-px" aria-label="Default select example" >
                    <option value={{ $livreurVehicule->vehicule->id}} selected >{{ $livreurVehicule->vehicule->immatriculation }}</option>
                    @forelse ($vehicules as $vehicule )
                    <option  value={{ $vehicule->id}} name="vehicule_id"> {{ $vehicule->immatriculation }}</option>
                    @empty

                    @endforelse


                  </select>
                </div>
                <div class="mb-3">
                <label for="nomTypeVehicule" class="form-label">Livreur</label>
                <select  name="livreur_id"class="form-select" aria-label="Default select example" >
                    <option  selected value={{ $livreurVehicule->livreur->id}} > {{ $livreurVehicule->livreur->user->email }}</option>
                    @forelse ($livreurs as $livreur )
                <option  value={{ $livreur->id}} name="livreur_id"> {{ $livreur->user->email }}</option>
                    @empty

                    @endforelse


                  </select>
                </div>

                  <div class= "container px- overflow-hidden">
                    <div class="row gx-2">
                      <div class="col">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      </div>
                      <div class="col">
                        <button type="submit" class="btn btn-success">Valider</button>
                      </div>
                    </div>
                  </div>
              </form>

        </div>

      </div>
    </div>
  </div>
@endsection
