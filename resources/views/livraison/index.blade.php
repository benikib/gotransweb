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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    <title>Liste des Livraisons</title>
    <style>
        .livraison-row {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 px-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize m-0">Liste des livraisons</h6>
                            <div class="d-flex align-items-center">
                                <div class="dropdown me-2">
                                    <button class="btn btn-link text-white dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-filter"></i> Filtrer
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                        <li><a class="dropdown-item" href="#" onclick="filterLivraisons('')">Tous les statuts</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterLivraisons('annulee')">Annulée</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterLivraisons('en_attente')">En attente</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterLivraisons('validee')">Validée</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterLivraisons('en_cours')">En cours</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterLivraisons('terminee')">Terminé</a></li>
                                    </ul>
                                </div>
                                <a href="{{ route('livraison.create') }}" class="btn btn-sm btn-primary">
                                    Créer une livraison
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="livraisonTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Expéditeur</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Destinataire</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Date de livraison</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Statut</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Véhicule</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($livraisons as $livraison)
                                    <tr class="livraison-row" data-status="{{ $livraison->status }}">
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $livraison->Expediteur->User->name ?? "Inconnu" }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $livraison->Destinateur->User->name ?? "Inconnu" }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Date de livraison</p>
                                            <p class="text-xs text-secondary mb-0">{{ $livraison->date }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{ getBadgeClass($livraison->status) }}">{{ $livraison->status }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $livraison->Vehicule->immatriculation ?? 'A/N' }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('livraison.edit', ['id' => $livraison->id]) }}" class="btn btn-info btn-sm me-1">Modifier</a>
                                                <a href="{{ route('livraison.delete', ['id' => $livraison->id]) }}" class="btn btn-danger btn-sm me-1">Supprimer</a>
                                                @if ($livraison->status === 'en_attente')
                                                    <button type="button" class="btn btn-primary btn-sm me-1" onclick="showLivraisonModal({{ $livraison->id }})">Accepter</button>
                                                @endif
                                                <button type="button" class="btn btn-link text-primary btn-sm me-1" id="toggle-btn-{{ $livraison->id }}" onclick="toggleDetails('details-{{ $livraison->id }}', 'toggle-btn-{{ $livraison->id }}')" style="text-decoration: none; font-weight: bold;">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr id="details-{{ $livraison->id }}" class="d-none">
                                        <td colspan="6" class="bg-light">
                                            <div class="p-2">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Détails</th>
                                                            <th>Informations</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Code</strong></td>
                                                            <td>{{ $livraison->code ?? 'Détails non disponibles' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Kilo total</strong></td>
                                                            <td>{{ $livraison->kilo_total ?? 'Non précisée' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Montant</strong></td>
                                                            <td>{{ $livraison->montant ?? 'Aucune' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Moyen de transport</strong></td>
                                                            <td>{{ $livraison->moyen_transport ?? 'Aucune' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Adresse expéditeur</strong></td>
                                                            <td>{{ $livraison->expedition->adresse ?? 'Aucune' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Téléphone expéditeur</strong></td>
                                                            <td>{{ $livraison->expedition->tel_expedition ?? 'Aucune' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Adresse destinataire</strong></td>
                                                            <td>{{ $livraison->destination->adresse ?? 'Aucune' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Téléphone destinataire</strong></td>
                                                            <td>{{ $livraison->destination->tel_destination ?? 'Aucune' }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
   function toggleDetails(id, buttonId) {
    const detailsRow = document.getElementById(id);
    const toggleButton = document.getElementById(buttonId);

    if (detailsRow.classList.contains('d-none')) {
        detailsRow.classList.remove('d-none');
        toggleButton.innerHTML = '<i class="bi bi-dash-lg"></i>'; // Icône pour "Réduire"
    } else {
        detailsRow.classList.add('d-none');
        toggleButton.innerHTML = '<i class="bi bi-plus-lg"></i>'; // Icône pour "Voir plus"
    }
}

    function filterLivraisons(status) {
        const rows = document.querySelectorAll('.livraison-row');

        // Masquer tous les détails avant de filtrer
        const detailRows = document.querySelectorAll('[id^="details-"]');
        detailRows.forEach(row => {
            row.classList.add('d-none');
        });

        rows.forEach(row => {
            if (status === "" || row.getAttribute('data-status') === status) {
                row.style.display = ""; // Afficher la ligne
            } else {
                row.style.display = "none"; // Cacher la ligne
            }
        });
    }
    </script>
</body>
</html>

<style>
/* Style pour le bouton "Voir plus" */
.btn-link {
    color: #007bff; /* Couleur du texte */
    background-color: transparent; /* Fond transparent */
    border: none; /* Pas de bordure */
    padding: 0; /* Pas de padding */
    font-size: 0.875rem; /* Taille de police */
    transition: color 0.3s; /* Transition douce */
}

.btn-link:hover {
    color: #0056b3; /* Couleur au survol */
}

/* Style pour les détails */
#details-{{ $livraison->id }} {
    border-top: 1px solid #dee2e6; /* Bordure supérieure */
}
</style>

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
