@extends('layouts.base')
@section('title', ' Modifier un véhicule')
@section('content')
<div class="container-fluid px-12 min-vh-100 d-flex justify-content-center align-items-center">
    <div class="modal-body shadow p-4 rounded bg-white">
      <form action="{{ route('vehicule.update',$vehicule->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nomModeleVehicule" class="form-label"> Type du véhicule</label>
            <select  name="type_vehicule_id"class="form-select" aria-label="Default select example" >
              <option  selected >{{ $vehicule->type_vehicule->nom_type }}</option>
              @forelse ($typeVehicules as $typeVehicule )
              <option  value={{ $typeVehicule->id}} name="id_type_vehicule"> {{ $typeVehicule->nom_type }}</option>
              @empty

              @endforelse


            </select>
          </div>

          <label for="nomTypeVehicule" class="form-label">Modele du véhicule</label>
          <select  name="modele_vehicule_id"class="form-select" aria-label="Default select example" >
              <option  selected >{{ $vehicule->modele_Vehicule->nom_modele }}</option>
              @forelse ($modeleVehicules as $modeleVehicule )
              <option  value={{ $modeleVehicule->id}} name="id_type_vehicule"> {{ $modeleVehicule->nom_modele }}</option>
              @empty

              @endforelse


            </select>
            <div class="mb-3">
              <label for="Immatriculation" class="form-label">Immatriculation</label>
              <input type="text" class="form-control" id="immatriculation" name="immatriculation" placeholder="Ex: 09BER">
            </div>
            <div class="mb-3">
            <select name="couleur" class="form-select" aria-label="Default select example">
              <option selected>{{ $vehicule->couleur }}</option>
              <option value="bleu">Blue</option>
              <option value="jaune">Jaune</option>
              <option value="blanc">Blanc</option>
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

@endsection
