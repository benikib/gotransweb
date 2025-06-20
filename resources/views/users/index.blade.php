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

@if ($_GET['m'] === 'admin')
<div class="card my-4 shadow-sm">
    <div class="card-header">
        <div class="border-radius-lg pt-4 pb-3 px-3 d-flex justify-content-between align-items-center">
            <h6 class="text-dark text-capitalize m-0">Administrateurs</h6>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="material-symbols-rounded me-1">person_add</i> Nouveau Administrateur
            </button>
        </div>
    </div>

    <div class="card-body px-4 pt-4 pb-2">
        <!-- Barre de recherche améliorée -->
        <div class="mb-4">
            <div class="input-group input-group-outline">
                <input type="text" id="searchAdmin" class="form-control form-control-sm"
                       placeholder="Rechercher par nom, email ou téléphone..."
                       onkeyup="filterAdminTable()">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-items-center mb-0" id="adminTable">
                <thead class="thead-light">
                    <tr>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">#</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Nom</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Email</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Téléphone</th>
                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Date création</th>
                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($admins as $admin)
                    <tr>
                        <td class="ps-3 align-middle">
                            <span class="text-xs font-weight-bold">{{ $count++ }}</span>
                        </td>

                        <td class="ps-3 align-middle">
                            <span class="text-xs font-weight-bold">{{ $admin->user->name }}</span>
                        </td>

                        <td class="ps-3 align-middle">
                            <span class="text-xs font-weight-bold">{{ $admin->user->email }}</span>
                        </td>

                        <td class="ps-3 align-middle">
                            <span class="text-xs font-weight-bold">{{ $admin->user->number_phone ?? 'N/A' }}</span>
                        </td>

                        <td class="text-center align-middle">
                            <span class="text-xs font-weight-bold">
                                {{ $admin->created_at->format('d/m/Y') }} <br>
                                <small class="text-muted">{{ $admin->created_at->format('H:i') }}</small>
                            </span>
                        </td>

                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-outline-primary me-2"
                                data-bs-toggle="modal"
                                data-bs-target="#editUserModal"
                                data-id="{{ $admin->user_id }}"
                                data-name="{{ $admin->user->name }}"
                                data-email="{{ $admin->user->email }}"
                                data-phone="{{ $admin->user->number_phone }}"
                                data-url="{{ route('users.update', $admin->user_id) }}"
                                data-mode="admin"
                                onclick="openEditModal(this)">
                                <i class="material-symbols-rounded text-sm">edit</i>
                            </button>

                            <form action="{{ route('users.destroy', $admin->user_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet administrateur ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="material-symbols-rounded text-sm">delete</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <span class="text-xs font-weight-bold">Aucun administrateur enregistré</span>
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
<div class="card my-4 shadow-sm">
    <div class="card-header">
        <div class="border-radius-lg pt-4 pb-3 px-3 d-flex justify-content-between align-items-center">
            <h6 class="text-dark text-capitalize m-0">Gestion des Livreurs</h6>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addLivreurModal">
                <i class="material-symbols-rounded me-1">person_add</i> Nouveau livreur
            </button>
        </div>
    </div>

    <div class="card-body px-4 pt-4 pb-2">
        <!-- Barre de recherche améliorée -->
        <div class="mb-4">
            <div class="input-group input-group-outline">
                <span class="input-group-text bg-transparent">
                    <i class="material-symbols-rounded">search</i>
                </span>
                <input type="text" id="searchLivreur" class="form-control form-control-sm"
                       placeholder="Rechercher par nom, email ou téléphone..."
                       onkeyup="filterLivreurTable()">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-items-center mb-0" id="livreurTable">
                <thead class="thead-light">
                    <tr>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">#</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Nom complet</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Email</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Téléphone</th>
                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Date création</th>
                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($livreurs as $livreur)
                    <tr>
                        <td class="ps-3 align-middle">
                            <span class="text-xs font-weight-bold">{{ $count++ }}</span>
                        </td>

                        <td class="ps-3 align-middle">
                            <div class="d-flex align-items-center">
                                {{-- <div class="avatar avatar-sm me-2">
                                    <img src="{{ asset($livreur->user->photo ?? 'assets/img/default-avatar.jpg') }}"
                                         class="avatar avatar-sm rounded-circle"
                                         alt="Avatar livreur">
                                </div> --}}
                                <span class="text-xs font-weight-bold">{{ $livreur->user->name }}</span>
                            </div>
                        </td>

                        <td class="ps-3 align-middle">
                            <span class="text-xs font-weight-bold">{{ $livreur->user->email }}</span>
                        </td>

                        <td class="ps-3 align-middle">
                            <span class="text-xs font-weight-bold">{{ $livreur->user->number_phone ?? 'N/A' }}</span>
                        </td>

                        <td class="text-center align-middle">
                            <span class="text-xs font-weight-bold">
                                {{ $livreur->created_at->format('d/m/Y') }}<br>
                                <small class="text-muted">{{ $livreur->created_at->format('H:i') }}</small>
                            </span>
                        </td>

                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-outline-primary me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserModal"
                                    data-id="{{ $livreur->user_id }}"
                                    data-name="{{ $livreur->user->name }}"
                                    data-email="{{ $livreur->user->email }}"
                                    data-phone="{{ $livreur->user->number_phone }}"
                                    data-url="{{ route('users.update', $livreur->user_id) }}"
                                    data-mode="livreur"
                                    onclick="openEditModal(this)">
                                    <i class="material-symbols-rounded text-sm">edit</i>
                                </button>

                                <form action="{{ route('users.destroy', $livreur->user_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce livreur ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="material-symbols-rounded text-sm">delete</i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <span class="text-xs font-weight-bold">Aucun livreur enregistré</span>
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
<div class="card my-4 shadow-sm">
    <div class="card-header">
        <div class="border-radius-lg pt-4 pb-3 px-3 d-flex justify-content-between align-items-center">
            <h6 class="text-dark text-capitalize m-0">Liste des Clients</h6>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addClientModal">
                <i class="material-symbols-rounded me-1">person_add</i> Nouveau client
            </button>
        </div>
    </div>

    <div class="card-body px-4 pt-4 pb-2">
        <!-- Barre de recherche améliorée -->
        <div class="mb-4">
            <div class="input-group input-group-outline">
                <span class="input-group-text bg-transparent">
                    <i class="material-symbols-rounded">search</i>
                </span>
                <input type="text" id="searchClient" class="form-control form-control-sm"
                       placeholder="Nom, email ou téléphone..."
                       onkeyup="filterClientTable()">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-items-center mb-0" id="clientTable">
                <thead class="thead-light">
                    <tr>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">#</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Client</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Coordonnées</th>
                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Inscription</th>
                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($clients as $client)
                    <tr>
                        <td class="ps-3 align-middle">
                            <span class="text-xs font-weight-bold">{{ $count++ }}</span>
                        </td>

                        <td class="ps-3 align-middle">
                            <div class="d-flex align-items-center">
                                {{-- <div class="avatar avatar-sm me-3">
                                    <img src="{{ asset($client->user->photo ?? 'assets/img/default-avatar.jpg') }}"
                                         class="avatar avatar-sm rounded-circle"
                                         alt="Photo client">
                                </div> --}}
                                <div>
                                    <span class="text-xs font-weight-bold d-block">{{ $client->user->name }}</span>
                                    {{-- <span class="text-xs text-muted">ID: {{ $client->user_id }}</span> --}}
                                </div>
                            </div>
                        </td>

                        <td class="ps-3 align-middle">
                            <span class="text-xs font-weight-bold d-block">{{ $client->user->email }}</span>
                            <span class="text-xs font-weight-bold">{{ $client->user->number_phone ?? 'Non renseigné' }}</span>
                        </td>

                        <td class="text-center align-middle">
                            <span class="text-xs font-weight-bold d-block">
                                {{ $client->created_at->format('d/m/Y') }}
                            </span>
                            <span class="text-xs text-muted">
                                {{ $client->created_at->format('H:i') }}
                            </span>
                        </td>

                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-outline-primary me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserModal"
                                    data-id="{{ $client->user_id }}"
                                    data-name="{{ $client->user->name }}"
                                    data-email="{{ $client->user->email }}"
                                    data-phone="{{ $client->user->number_phone }}"
                                    data-url="{{ route('users.update', $client->user_id) }}"
                                    data-mode="client"
                                    onclick="openEditModal(this)">
                                    <i class="material-symbols-rounded text-sm me-1">edit</i>
                                </button>

                                <form action="{{ route('users.destroy', $client->user_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce livreur ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="material-symbols-rounded text-sm">delete</i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="material-symbols-rounded text-muted mb-2" style="font-size: 48px;">group_off</i>
                                <span class="text-xs font-weight-bold">Aucun client enregistré</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal user -->



@endif
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
           <!-- CHAMP MODE -->
        <input type="hidden" name="m" id="modeField">
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
  function openEditModal(button) {
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');
    const email = button.getAttribute('data-email');
    const phone = button.getAttribute('data-phone');
    const url = button.getAttribute('data-url');
    const mode = button.getAttribute('data-mode');

    // Remplir les champs du formulaire
    document.getElementById('firstname').value = name;
    document.getElementById('email').value = email;
    document.getElementById('phone').value = phone;
    document.getElementById('password').value = "";

    // Mettre à jour l'URL du formulaire
    const form = document.getElementById('updateUserForm');
    form.action = url;

    // Remplir ou créer le champ caché "m"
    const modeField = document.getElementById('modeField');
    modeField.value = mode;
  }
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
