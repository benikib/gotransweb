@extends('layouts.base')
@section('title', ' Edite Type de véhicule')
@section('content')
<div class="container-fluid px-12 min-vh-100 d-flex justify-content-center align-items-center">
    <div class="modal-body shadow p-4 rounded bg-white">
      <form action="{{ route('tarifs.update',$tarif->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nomtarif" class="form-label">Kilo  du tarification</label>
            <input type="number" class="form-control" id="nomtarif" name="kilo_tarif" placeholder="Ex: 1 , 2, 3"value="{{ $tarif->kilo_tarif }}">
          </div>
          <div class="mb-3">
          <label for="tarif" class="form-label"> prix du Tarif</label>
          <input type="number" class="form-control" id="tarif" name="prix_tarif" placeholder="Ex: 2 , 3 , 10 " value="{{ $tarif->prix_tarif }}">
        
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
