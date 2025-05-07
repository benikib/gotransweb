@extends('layouts.base')
@section('title', ' Edite Type de véhicule')
@section('content')
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
    <div class="modal-body shadow p-4 rounded bg-white">
      <form action="{{ route('vehicule.update',$vehicule->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nomModeleVehicule" class="form-label"> Type du véhicule</label>
            <select  name="type_vehicule_id"class="form-select" aria-label="Default select example" >
              <option  selected >Open this select menu</option>
              @forelse ($typeVehicules as $typeVehicule )
              <option  value={{ $typeVehicule->id}} name="id_type_vehicule"> {{ $typeVehicule->nom_type }}</option>
              @empty

              @endforelse


            </select>
          </div>

          <label for="nomTypeVehicule" class="form-label">Modele du véhicule</label>
          <select  name="modele_vehicule_id"class="form-select" aria-label="Default select example" >
              <option  selected >Open this select menu</option>
              @forelse ($modeleVehicules as $modeleVehicule )
              <option  value={{ $modeleVehicule->id}} name="id_type_vehicule"> {{ $modeleVehicule->nom_modele }}</option>
              @empty

              @endforelse


            </select>
            <div class="mb-3">
              <label for="Immatriculation" class="form-label">Immatriculation</label>
              <input type="text" class="form-control" id="immatriculation" name="immatriculation" placeholder="Ex: 09BER">
            </div>
            <select name="couleur" class="form-select" aria-label="Default select example">
              <option selected>Couleur du vehicule</option>
              <option value="bleu">Blue</option>
              <option value="jaune">Jaune</option>
              <option value="blanc">Blanc</option>
            </select>
            
        <div class="container overflow-hidden">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

          <button type="submit" class="btn btn-success">Modifier</button>
        </div>
      </form>
    </div>
  </div>

@endsection
