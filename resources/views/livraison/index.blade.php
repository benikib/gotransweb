@extends("layouts.base")
@section('title', 'livraisons')
@section("content")

@php
function getBadgeClass($status) {
          return 'badge badge-sm ' . match ($status) {
            'terminee'     => 'bg-gradient-success',
            'en_attente' => 'bg-gradient-warning',
            'annulee'    => 'bg-gradient-danger',
            'en_cours'   => 'bg-gradient-info',
            'validee'    => 'bg-gradient-secondary',
            default  => 'bg-gradient-secondary'
        };

    }

@endphp

<div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">

          <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
  <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 px-3">
    <div class="d-flex justify-content-between align-items-center">
      <h6 class="text-white text-capitalize m-0">Liste des livraisons</h6>
      <a href="{{ route('livraison.create') }}" class="btn btn-primary">
        Créer une livraison (test)
      </a>
    </div>
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
                          <i class="bi bi-person text-primary fs-2"></i>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$livraison->Expediteur->User->name ?? ""}}</h6>
                            <p class="text-xs text-secondary mb-0"></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                           <i class="bi bi-person text-primary fs-2"></i>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$livraison->Destinateur->User->name ?? ""}} </h6>
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
                        <span class="text-secondary text-xs font-weight-bold">{{$livraison->Vehicule->immatriculation ?? ''}}</span>
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
                        <div class="btn btn-danger btn-sm" type="button" >Suppimer</div>
                        </a>

                      <button type="button" class="btn btn-primary" onclick="showLivraisonModal({{ $livraison->id }})">
  Accepter
</button>



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

      <!-- Bouton pour ouvrir la modal -->



<!-- Modal -->
   @include('livraison.affecterVehiculeLivreur')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

  function showLivraisonModal(id) {
      $.ajax({
          url: "{{ route('livraison.affectation', ['id' => ':id']) }}".replace(':id', id),
          type: "GET",
          success: function (data) {
              // Vérifiez si la réponse est un succès

              if (data.status === 'success') {
                  const select = document.getElementById('type_vehicule');
                  let id_livraison = document.getElementById('id_livraison');
                    id_livraison.value = data["id"];

                  // Vide le select d'abord
                  select.innerHTML = '';

                  let valuePardefaut=data["data"][0]["id"];
                  selectVehicule(valuePardefaut);

                  data["data"].forEach(vehicule => {
                      const option = document.createElement('option');
                      option.value = vehicule["id"];
                      option.textContent = vehicule.nom_type;
                      select.appendChild(option);
                  });

                  select.addEventListener('change', function () {
                      const selectedId = this.value;
                      selectVehicule(selectedId);
                  });


              }

              // Affiche le modal
              var modal = new bootstrap.Modal(document.getElementById('modalLivraison'));
              modal.show();
          },
          error: function (xhr, status, error) {
              console.error('Erreur :', error);
          }
      });
  }


    function selectVehicule(id) {

       $.ajax({
          url: "{{ route('livraison.selectAffectation', ['id' => ':id']) }}".replace(':id', id),
          type: "GET",
          success: function (data) {

              if (data.status === 'success') {
                  const select = document.getElementById('vehicule');

                  // Vide le select d'abord
                  select.innerHTML = '';
                    let valuePardefaut=data["data"][0]["id"];
                  selectLivreur(valuePardefaut);

                  data["data"].forEach(vehicule => {
                      const option = document.createElement('option');
                      option.value =  vehicule.id;
                      option.textContent = vehicule.immatriculation;
                      select.appendChild(option);
                  });
                    select.addEventListener('change', function () {
                      const selectedId = this.value;
                      selectLivreur(selectedId);
                  });
              }
          },
          error: function (xhr, status, error) {
              console.error('Erreur :', error);
          }
      });

    }

    function selectLivreur(id) {

       $.ajax({
          url: "{{ route('livraison.selectLivreur', ['id' => ':id']) }}".replace(':id', id),
          type: "GET",
          success: function (data) {



               const select = document.getElementById('livreur');

                  //  'livreurs.id as livreur_id',
                    // 'users.name as livreur_name',
                    // 'users.number_phone as livreur_telephone',
                    // 'users.email as livreur_email'


                  select.innerHTML = '';

                  data["data"].forEach(livreur => {
                      const option = document.createElement('option');
                      option.value =  livreur["livreur_id"];
                      option.textContent =livreur["livreur_name"] + ' - ' + livreur["livreur_telephone"];
                      select.appendChild(option);
                  });
          },
          error: function (xhr, status, error) {
              console.error('Erreur :', error);
          }
      });



    }
</script>

@endsection
