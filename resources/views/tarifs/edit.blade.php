@extends('layouts.base')
@section('title', ' Edite Type de véhicule')
@section('content')
<div class="container-fluid px-12 min-vh-100 d-flex justify-content-center align-items-center">
    <div class="modal-body shadow p-4 rounded bg-white">
<form action="{{ route('tarifs.update', $tarif->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nomtarif" class="form-label">Kilo de tarification</label>
        <input type="number" class="form-control" id="nomtarif" name="kilo_tarif"
               placeholder="Ex: 1, 2, 3" value="{{ $tarif->kilo_tarif }}"
               style="border: 1px solid #000;">
    </div>

    <div class="mb-3">
        <label for="tarif" class="form-label">Prix du Tarif</label>
        <input type="number" class="form-control" id="tarif" name="prix_tarif"
               placeholder="Ex: 2, 3, 10" value="{{ $tarif->prix_tarif }}"
               style="border: 1px solid #000;">
    </div>

    <div class="container px-3 overflow-hidden">
        <div class="row gx-2">
            <div class="col">
                <button type="button" class="btn btn-secondary" onclick="history.back()">Annuler</button>
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
