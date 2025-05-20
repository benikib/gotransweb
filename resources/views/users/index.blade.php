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

   <div class="card my-4">
    <div class="card-header p-0 mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
            <h6 class="text-white text-capitalize m-0">Administrateur</h6>
            <!-- Bouton pour collapse -->
            <button class="btn btn-outline-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#adminCollapse">
                Afficher / Masquer
            </button>
        </div>
    </div>
    <div class="card-body collapse" id="adminCollapse">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">

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
                          <!-- ID -->
                          <td class="align-middle">
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $count++ }}</h6>
                              </div>
                            </div>
                          </td>

                          <!-- Nom -->
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $admin->user->name ?? " " }}</p>
                          </td>

                          <!-- Email -->
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $admin->user->email }}</p>
                          </td>
                          <!-- Email -->
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $admin->user->number_phone }}</p>
                          </td>
                          <!-- Timestamp -->
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              {{ $admin->created_at->format('d/m/Y H:i') }}
                            </span>
                          </td>

                          <!-- Bouton Edit -->
                          <td class="align-middle text-begin">
                            <a href="{{route('users.edit', ['user'=>$admin->user->id]) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                                Éditer
                            </a>
                        </td>

                        <!-- Bouton Supprimer -->
                        {{-- <td class="align-middle text-start">
                            <form action="{{route('users.destroy', $admin->user)}}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger text-xs p-0 m-0" style="text-decoration: none;" title="Supprimer">
                                    Supprimer
                                </button>
                            </form>

                        </td> --}}

                        </tr>

                        @empty
                          <tr>
                              <td colspan="5" class="text-center">
                              <p class="text-xs font-weight-bold mb-0">Aucun Admin enregistrer.</p>
                              </td>
                        @endforelse

                      </tbody>

            </table>
        </div>
    </div>
</div>




      </div>


        {{-- livreur --}}
        <div class="card my-4">
            <div class="card-header p-0 mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                    <h6 class="text-white text-capitalize m-0">Livreurs</h6>
                    <!-- Bouton pour collapse -->
                    <button class="btn btn-outline-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#livreurCollapse">
                        Afficher / Masquer
                    </button>
                </div>
            </div>
            <div class="card-body collapse" id="livreurCollapse">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">

                            <thead>
                              <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N°</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">nom</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Téléphone</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation</th>
                                <th class="text-secondary opacity-7"></th>
                              </tr>
                            </thead>

                            {{-- /livreur --}}
                            <tbody>
                                  @php
                                      $count = 1;
                                  @endphp
                                @forelse ($livreurs as $livreur)
                                <tr>
                                  <!-- ID -->
                                  <td class="align-middle">
                                    <div class="d-flex px-2 py-1">
                                      <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $count++ }}</h6>
                                      </div>
                                    </div>
                                  </td>

                                  <!-- Nom -->
                                  <td class="align-middle">
                                    <p class="text-xs font-weight-bold mb-0">{{ $livreur->user->name }}</p>
                                  </td>

                                  <!-- Email -->
                                  <td class="align-middle">
                                    <p class="text-xs font-weight-bold mb-0">{{ $livreur->user->email }}</p>
                                  </td>
                                  <!-- Phone -->
                                  <td class="align-middle">
                                    <p class="text-xs font-weight-bold mb-0">{{ $livreur->user->number_phone }}</p>
                                  </td>
                                  <!-- Timestamp -->
                                  <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">
                                      {{ $livreur->created_at->format('d/m/Y H:i') }}
                                    </span>
                                  </td>

                                  <!-- Bouton Edit -->
                                  <td class="align-middle text-begin">
                                    <a href="{{route('users.edit', $livreur->user->id) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
                                        Éditer
                                    </a>
                                </td>

                                <!-- Bouton Supprimer -->
                                {{-- <td class="align-middle text-start">
                                    <form action="{{route('users.destroy', $livreur->user->id)}}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger text-xs p-0 m-0" style="text-decoration: none;" title="Supprimer">
                                            Supprimer
                                        </button>
                                    </form>
                                </td> --}}

                                </tr>

                                @empty
                                  <tr>
                                      <td colspan="5" class="text-center">
                                      <p class="text-xs font-weight-bold mb-0">Aucun livreur enregistrer.</p>
                                      </td>
                                @endforelse

                              </tbody>

                    </table>
                </div>
            </div>
        </div>


              {{-- clients --}}

                <div class="card my-4">
                    <div class="card-header p-0 mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                            <h6 class="text-white text-capitalize m-0">Client</h6>
                            <!-- Bouton pour collapse -->
                            <button class="btn btn-outline-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#clientCollapse">
                                Afficher / Masquer
                            </button>
                        </div>
                    </div>
                    <div class="card-body collapse" id="clientCollapse">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">

                                    <thead>
                                      <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N°</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">nom</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Téléphone</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation</th>
                                        <th class="text-secondary opacity-7"></th>
                                      </tr>
                                    </thead>

                                    {{-- /client --}}
                                    <tbody>
                                          @php
                                              $count = 1;
                                          @endphp
                                        @forelse ($clients as $client)
                                        <tr>
                                          <!-- ID -->
                                          <td class="align-middle">
                                            <div class="d-flex px-2 py-1">
                                              <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $loop->itetration }}</h6>
                                              </div>
                                            </div>
                                          </td>

                                          <!-- Nom -->
                                          <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $client->user->name ?? " " }}</p>
                                          </td>

                                          <!-- Email -->
                                          <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $client->user->email }}</p>
                                          </td>
                                          <!-- Phone -->
                                          <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $client->user->number_phone }}</p>
                                          </td>

                                          <!-- Timestamp -->
                                          <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                              {{ $client->created_at->format('d/m/Y H:i') }}
                                            </span>
                                          </td>

                                          <!-- Bouton Edit -->
                                     <!-- Bouton Edit -->
<td class="align-middle text-begin">
    <a href="{{route('users.edit', $client->user->id) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" title="Modifier">
        Éditer
    </a>
</td>

<!-- Bouton Supprimer -->
{{-- <td class="align-middle text-start">
    <form action="{{route('users.destroy', $client->user->id)}}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-link text-danger text-xs p-0 m-0" style="text-decoration: none;" title="Supprimer">
            Supprimer
        </button>
    </form>
</td> --}}


                                        @empty
                                          <tr>
                                              <td colspan="5" class="text-center">
                                              <p class="text-xs font-weight-bold mb-0">Aucun enregistrer.</p>
                                              </td>
                                        @endforelse

                                      </tbody>

                            </table>
                        </div>
                    </div>
                </div>

 @include('users.create')
      @endsection
