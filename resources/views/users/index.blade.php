@extends('layouts.base')
@section('title', 'Utilisateurs')
@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif

{{-- Script pour faire disparaître les messages après 5 secondes --}}
<script>
    setTimeout(() => {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach((alert) => {
            // Démarre l'effet de disparition Bootstrap
            alert.classList.remove('show');
            alert.classList.add('fade');
            // Supprime l'élément du DOM après la transition
            setTimeout(() => alert.remove(), 500); // temps pour l'animation fade
        });
    }, 3000); // 5000ms = 5 secondes
</script>

<div class="text-end mb-3" style="margin-right: 70px;">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajouter
    </button>
</div>

@if ($_GET['m'] === 'admin')
<div class="card my-4">
    <div class="card-header p-0 mt-n4 mx-3 z-index-2">
        <div class="bg-white shadow border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
            <h6 class="text-dark text-capitalize m-0">Administrateur</h6>
        </div>
    </div>

    <div class="card-body">
        <!-- Barre de recherche -->
        <div class="mb-3">
            <input type="text" id="searchAdmin" class="form-control" placeholder="Rechercher un admin par nom, email ou téléphone..." onkeyup="filterAdminTable()">
        </div>

        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0" id="adminTable">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N°</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">email</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Téléphone</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Création</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($admins as $admin)
                    <tr>
                        <td class="align-middle">
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $count++ }}</h6>
                                </div>
                            </div>
                        </td>

                        <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $admin->user->name }}</p>
                        </td>

                        <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $admin->user->email }}</p>
                        </td>

                        <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $admin->user->number_phone }}</p>
                        </td>

                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                                {{ $admin->created_at->format('d/m/Y H:i') }}
                            </span>
                        </td>

                        <td class="align-middle text-begin">
                            <button
    class="btn btn-link text-dark px-2 mb-0"
    data-bs-toggle="modal"
    data-bs-target="#editUserModal"
    onclick="openEditModal(
        {{ $admin->user_id }},
        @js($admin->user->name),
        @js($admin->user->email),
        @js($admin->user->number_phone)
    )"
>
    <i class="material-symbols-rounded text-lg">edit</i>
</button>

                            {{-- <a href="{{ route('users.edit', ['user' => $admin->user->id]) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                                Éditer
                            </a> --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Aucun Admin enregistré.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endif
@if ($_GET['m'] === 'livreur')
<div class="card my-4">
    <div class="card-header p-0 mt-n4 mx-3 z-index-2">
        <div class="bg-white shadow border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
            <h6 class="text-dark text-capitalize m-0">Livreurs</h6>
        </div>
    </div>

    <div class="card-body">
        <!-- Barre de recherche -->
        <div class="mb-3">
            <input type="text" id="searchLivreur" class="form-control" placeholder="Rechercher un livreur par nom, email ou téléphone..." onkeyup="filterLivreurTable()">
        </div>

        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0" id="livreurTable">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N°</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Téléphone</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Création</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>

                {{-- /Livreur --}}
                <tbody>
                    @forelse ($livreurs as $livreur)
                    <tr>
                        <td class="align-middle">
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $count++ }}</h6>
                                </div>
                            </div>
                        </td>

                        <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $livreur->user->name }}</p>
                        </td>

                        <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $livreur->user->email }}</p>
                        </td>

                        <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $livreur->user->number_phone }}</p>
                        </td>

                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                                {{ $livreur->created_at->format('d/m/Y H:i') }}
                            </span>
                        </td>

                        <td class="align-middle text-begin">
                            <a href="{{ route('users.edit', ['user' => $livreur->user->id]) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                                Éditer
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Aucun livreur enregistré.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endif
@if ($_GET['m'] === 'client')
<div class="card my-4">
    <div class="card-header p-0 mt-n4 mx-3 z-index-2">
        <div class="bg-white shadow border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
            <h6 class="text-dark text-capitalize m-0">Clients</h6>
        </div>
    </div>

    <div class="card-body">
        <!-- Barre de recherche -->
        <div class="mb-3">
            <input type="text" id="searchClient" class="form-control" placeholder="Rechercher un client par nom, email ou téléphone..." onkeyup="filterClientTable()">
        </div>

        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0" id="clientTable">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N°</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Téléphone</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Création</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>

                {{-- /Client --}}
                <tbody>
                    @forelse ($clients as $client)
                    <tr>
                        <td class="align-middle">
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $count++ }}</h6>
                                </div>
                            </div>
                        </td>

                        <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $client->user->name }}</p>
                        </td>

                        <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $client->user->email }}</p>
                        </td>

                        <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $client->user->number_phone }}</p>
                        </td>

                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                                {{ $client->created_at->format('d/m/Y H:i') }}
                            </span>
                        </td>

                        <td class="align-middle text-begin">
                            <a href="{{ route('users.edit', ['user' => $client->user->id]) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                                Éditer
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Aucun client enregistré.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal user -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title" id="editUserModalLabel">Modifier un utilisateur</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <form id="updateUserForm" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="firstname" class="form-label fw-bold">Nom</label>
            <input type="text" class="form-control" name="name" id="firstname" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label fw-bold">Téléphone</label>
            <input type="tel" class="form-control" name="number_phone" id="phone">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label fw-bold">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary rounded-3">Enregistrer</button>
          </div>
        </form>
        <div id="successMessage" class="alert alert-success mt-3 d-none"></div>
      </div>
    </div>
  </div>
</div>
@endif
<script>
  function openEditModal(id, name, email, phone) {
    // Remplissage des champs
    document.getElementById('firstname').value = name;
    document.getElementById('email').value = email;
    document.getElementById('phone').value = phone;
    document.getElementById('password').value = "";

    // Met à jour l'action du formulaire
    const form = document.getElementById('updateUserForm');
    form.action = "{{ route('users.update', ':id') }}".replace(':id', id);

  }
</script> 
<script>
        // Activer les tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
<script>
    function filterAdminTable() {
        let input = document.getElementById("searchAdmin");
        let filter = input.value.toLowerCase();
        let table = document.getElementById("adminTable");
        let trs = table.getElementsByTagName("tr");

        for (let i = 1; i < trs.length; i++) { // ignore le header
            let tds = trs[i].getElementsByTagName("td");
            let match = false;
            for (let j = 0; j < tds.length; j++) {
                if (tds[j] && tds[j].textContent.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
            trs[i].style.display = match ? "" : "none";
        }
    }
</script>

<script>
    function filterLivreurTable() {
        var input = document.getElementById("searchLivreur");
        var filter = input.value.toLowerCase();
        var rows = document.querySelectorAll("#livreurTable tbody tr");

        rows.forEach(function(row) {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    }
</script>
<script>
    function filterClientTable() {
        var input = document.getElementById("searchClient");
        var filter = input.value.toLowerCase();
        var rows = document.querySelectorAll("#clientTable tbody tr");

        rows.forEach(function(row) {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    }
</script>




 @include('users.create')
      @endsection
