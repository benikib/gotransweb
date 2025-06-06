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
            <!-- Bouton pour collapse -->
            <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#adminCollapse">
                Afficher / Masquer
            </button>
        </div>
    </div>

    <div class="card-body collapse" id="adminCollapse">
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
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>

                {{-- /Admin --}}
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
                            <a href="{{route('users.edit', ['user'=>$admin->user->id]) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                                Éditer
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Aucun Admin enregistré.</p>
                        </td>
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
            <!-- Bouton pour collapse -->
            <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#adminCollapse">
                Afficher / Masquer
            </button>
        </div>
    </div>

    <div class="card-body collapse" id="adminCollapse">
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
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation</th>
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
                            <a href="{{route('users.edit', ['user'=>$livreur->user->id]) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                                Éditer
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Aucun Admin enregistré.</p>
                        </td>
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
            <h6 class="text-dark text-capitalize m-0">Client</h6>
            <!-- Bouton pour collapse -->
            <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#adminCollapse">
                Afficher / Masquer
            </button>
        </div>
    </div>

    <div class="card-body collapse" id="adminCollapse">
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
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation</th>
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
                            <a href="{{route('users.edit', ['user'=>$client->user->id]) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                                Éditer
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Aucun Admin enregistré.</p>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
  <div class="card my-4">
    <div class="card-header p-0 mt-n4 mx-3 z-index-2">
        <div class="bg-white shadow border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
            <h6 class="text-dark text-capitalize m-0">Administrateur</h6>
            <!-- Bouton pour collapse -->
            <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#adminCollapse">
                Afficher / Masquer
            </button>
        </div>
    </div>

    <div class="card-body collapse" id="adminCollapse">
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
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>

                {{-- /Admin --}}
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
                            <a href="{{route('users.edit', ['user'=>$admin->user->id]) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                                Éditer
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Aucun Admin enregistré.</p>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
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





 @include('users.create')
      @endsection
