@extends('layouts.base')
@section('title', ' Edite Type de véhicule')
@section('content')
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
    <div class="modal-body shadow p-4 rounded bg-white">
      <form action="{{ route('modeleVehicule.update',$modeleVehicule->id) }}" method="POST">
        @csrf

            <div class="mb-3 container bg-center ">
                <label for="nomModeleVehicule" class="form-label" >Nom du Modele de véhicule</label>
                <input type="text" class="form-control" id="nomModeleVehicule" name="nom_modele" value="{{ $modeleVehicule->nom_modele }}" placeholder="Ex: spriter.">

              <label for="tarif" class="form-label">Tarif</label>
              <input type="number" class="form-control" id="tarif" name="tarif" value="{{ $modeleVehicule->tarif }}" placeholder="Ex: 2000">

    </div>
        <div class="container overflow-hidden">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

          <button type="submit" class="btn btn-success">Modifier</button>
        </div>
      </form>
    </div>
  </div>

@endsection
