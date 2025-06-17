@extends('layouts.base')
@section('title', ' Modifier un véhicule')
@section('content')
<div class="container-fluid px-12 min-vh-100 d-flex justify-content-center align-items-center">
    <div class="modal-body shadow p-4 rounded bg-white">
      <form action="{{ route('vehicule.update',$vehicule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Immatriculation" class="form-label">Numéro d'immatriculation</label>
            <input type="text" class="form-control" id="immatriculation" name="immatriculation" value="{{ $vehicule->immatriculation }}" placeholder="Ex: 09BER" required>
          </div>

        <div class="mb-3">
            <label for="nomModeleVehicule" class="form-label"> Type du véhicule</label>
            <select  name="type_vehicule_id"class="form-select" aria-label="Default select example" >
              <option  selected value={{ $vehicule->type_vehicule->id}} >{{ $vehicule->type_vehicule->nom_type }}</option>
              @forelse ($typeVehicules as $typeVehicule )
              <option  value={{ $typeVehicule->id}} name="id_type_vehicule"> {{ $typeVehicule->nom_type }}</option>
              @empty
              @endforelse
            </select>
        </div>



            {{-- <div class="mb-3">
            <select name="couleur" class="form-select" aria-label="Default select example">
              <option selected>{{ $vehicule->couleur }}</option>
              <option value="bleu">Blue</option>
              <option value="jaune">Jaune</option>
              <option value="blanc">Blanc</option>
            </select>
            </div> --}}
            <div class="mb-3">
                <select  name="etat" class="form-select" aria-label="Default select example">
                  <option selected>Etat du vehicule</option>
                  <option value="1">Bon</option>
                  <option value="0">Mauvais</option>
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
  <style>
  .form-control, select.form-select {
  border: 1px solid #000; /* bordure noire 1px */
  border-radius: 4px; /* coins légèrement arrondis */
}

</style>

@endsection
