@extends('layouts.base')
@section('title', ' véhicule')
@section('content')
<div class="container-fluid px-12 min-vh-100 d-flex justify-content-center align-items-center">
    <div class="modal-body shadow p-4 rounded bg-white">
      <form action="{{ route('typeVehicule.update',$typeVehicule->id) }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="nomTypeVehicule" class="form-label">Nom du type de véhicule</label>
          <input type="text" class="form-control" id="nomTypeVehicule" name="nom_type" placeholder="Ex: Camion, Moto, etc." value="{{ $typeVehicule->nom_type }}">
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

@endsection
