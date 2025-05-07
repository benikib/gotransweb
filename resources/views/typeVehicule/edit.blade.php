@extends('layouts.base')
@section('title', ' Edite Type de véhicule')
@section('content')
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
    <div class="modal-body shadow p-4 rounded bg-white">
      <form action="{{ route('typeVehicule.update',$typeVehicule->id) }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="nomTypeVehicule" class="form-label">Nom du type de véhicule</label>
          <input type="text" class="form-control" id="nomTypeVehicule" name="nom_type" placeholder="Ex: Camion, Moto, etc." value="{{ $typeVehicule->nom_type }}">
        </div>
        <div class="container overflow-hidden">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

          <button type="submit" class="btn btn-success">Modifier</button>
        </div>
      </form>
    </div>
  </div>

@endsection
