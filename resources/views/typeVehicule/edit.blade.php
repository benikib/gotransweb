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
        <div class="mb-3">
            <label for="nomtarif" class="form-label"> Tarif Kilo  initial</label>
            <input type="number" class="form-control" id="nomtarif" name="kilo_initiale" placeholder="Ex: 1 , 2, 3" value="{{ $typeVehicule->kilo_initiale }}">
          </div>
          <div class="mb-3">
          <label for="tarif" class="form-label"> Tarif Kilo final</label>
          <input type="number" class="form-control" id="tarif" name="kilo_final" placeholder="Ex: 2 , 3 , 10 " value="{{ $typeVehicule->kilo_final }}">
        </div>
        <div class="mb-3">
            <label for="nomModeleVehicule" class="form-label"> Type du véhicule</label>
            <select  name="tarif_id"class="form-select" aria-label="Default select example" >
              <option  selected value={{ $typeVehicule->$tarif->id}} >{{ $typeVehicule->$tarif->kilo_tarif. '  kilo / $ ' .$typeVehicule->$tarif->prix_tarif  }}</option>
              @forelse ($tarifs as $tarif )
              <option  value={{ $tarif->id}} > {{ $tarif->kilo_tarif. '  kilo / $ ' . $tarif->prix_tarif  }}</option>
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
        </div>

          </div>

      </form>
    </div>
  </div>

@endsection
