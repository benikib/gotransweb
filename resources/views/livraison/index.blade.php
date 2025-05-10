@extends("layouts.base")
@section('title', 'all_livraison')
@section('content') 

@php
function getBadgeClass($status) {
        return 'badge badge-sm ' . match ($status) {
            'livree'    => 'bg-gradient-success',
            'en_attente'  => 'bg-gradient-warning',
            'annulee'   => 'bg-gradient-danger',
            'en_cours'   => 'bg-gradient-info',
        };
    }

@endphp
<div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
         
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Liste des livraisons</h6>
                <a href="{{ route('livraison.create') }}">
                  <div class="btn btn-primary">Creer une livraison(teste)</div>
                </a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expediteur</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Destinateur</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date de livraison</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">vihicule</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Info Destination</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Info Expedition</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>

                @foreach ($livraisons as $livraison)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$livraison->Destinateur->User->name }}</h6>
                            <p class="text-xs text-secondary mb-0"></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$livraison->Expediteur->User->name}} </h6>
                            <p class="text-xs text-secondary mb-0"></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Date de livraison</p>
                        <p class="text-xs text-secondary mb-0">{{$livraison->date}} </p>
                      </td>

                      <td class="align-middle text-center text-sm">
                      
                        <span class="badge badge-sm {{ getBadgeClass($livraison->status) }}">{{$livraison->status}}</span>
                      </td>
                   
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$livraison->Vehicule->immatriculation}}</span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $livraison->Destination->adresse ?? 'N/A' }},{{ $livraison->Destination->tel_destination ?? 'N/A' }}</span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$livraison->Expedition->adresse ?? 'N/A'}},{{$livraison->Expedition->tel_expedition?? 'N/A'}}</span>
                      </td>
                      <td class="align-middle">
                        <a href="{{ route('livraison.edit', ['id'=>$livraison->id]) }}" >
                         
                        <div class="btn btn-info btn-sm" type="button" >Modifier</div>
                        </a>
                        <a href="{{ route('livraison.delete', ['id'=>$livraison->id]) }}">
                        <div class="btn btn-primary btn-sm" type="button" >Suppimer</div>
                        </a>
                        
                        </div>
                      </td>
                    </tr>


                @endforeach


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection()