@extends('layouts.base')
@section('title', 'Tarification ')
@section('content')
    @if (session('success'))
        <div class="alert alert-success m-4 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert  m-4 alert-danger alert-dismissible  fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert m-4 alert-warning alert-dismissible fade show" role="alert">
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
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4 shadow-sm">
                    <div class="card-header">
                        <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                            <h6 class="text-dark text-capitalize m-0">
                                <i class="material-symbols-rounded me-2">local_shipping</i> Gestion des Tarifs
                            </h6>
                            <div>
                                <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#addKiloTarifModal">
                                    <i class="material-symbols-rounded me-1">add</i> Tarif au kilo
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addCourseTarifModal">
                                    <i class="material-symbols-rounded me-1">add</i> Tarif à la course
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-3">
                            <table class="table table-hover align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">#</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Type</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-3">Détails
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">
                                            Prix</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">
                                            Enregistrement</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tarifs as $tarif)
                                        <tr>
                                            <td class="ps-3 align-middle">
                                                <span class="text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                            </td>

                                            <td class="ps-3 align-middle">
                                                <span class=" text-xs font-weight-bold">
                                                    {{ $tarif->type }}
                                                </span>
                                            </td>

                                            <td class="ps-3 align-middle">
                                                <div class="d-flex align-items-center">
                                                    <i class="material-symbols-rounded text-sm me-2">directions_car</i>
                                                    <span class="text-xs font-weight-bold">{{ $tarif->nom }}</span>
                                                </div>
                                            </td>

                                            <td class="text-center align-middle">
                                                <span class="  text-xs font-weight-bold">
                                                    {{ number_format($tarif->prix, 2) }} {{ $tarif->devise }} /
                                                    {{ $tarif->valeur }}
                                                    {{ $tarif->type }}
                                                </span>
                                            </td>

                                            <td class="text-center align-middle">
                                                <span class="text-xs font-weight-bold d-block">
                                                    {{ $tarif->created_at->format('d/m/Y') }}
                                                </span>
                                                <span class="text-xs text-muted">
                                                    {{ $tarif->created_at->format('H:i') }}
                                                </span>
                                            </td>

                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-sm btn-outline-primary me-2"
                                                        data-bs-toggle="modal" data-bs-target="#editTarifModal"
                                                        title="Modifier"
                                                        onclick="openEditModal(
                                                    '{{ $tarif->id }}',
                                                    '{{ $tarif->type }}',
                                                    '{{ $tarif->nom }}',
                                                    '{{ $tarif->valeur }}',
                                                    '{{ $tarif->prix }}'
                                                )">
                                                        <i class="material-symbols-rounded text-sm me-1">edit</i>
                                                    </button>
                                                    <form action="{{ route('tarifs.destroy', $tarif->id) }}" method="POST"
                                                        class="d-inline" onsubmit="return confirm('Supprimer ce tarif ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="material-symbols-rounded text-sm me-1">delete</i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="material-symbols-rounded text-muted mb-2"
                                                        style="font-size: 48px;">receipt_long</i>
                                                    <span class="text-xs font-weight-bold">Aucun tarif enregistré</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajout Tarif au kilo -->
    <div class="modal fade" id="addKiloTarifModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addKiloTarifModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKiloTarifModalLabel">Nouveau tarif au kilo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tarifs.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="kilo">

                        <div class="mb-3">
                            <label for="kilo_nom" class="form-label">Nom du tarif</label>
                            <input type="text" class="form-control border border-secondary" id="kilo_nom"
                                name="nom" placeholder="Ex: Standard" required>
                        </div>

                        <div class="mb-3">
                            <label for="kilo_valeur" class="form-label">Poids (kg)</label>
                            <input type="number" class="form-control border border-secondary" id="kilo_valeur"
                                name="valeur" placeholder="Ex: 1, 2, 3" required>
                        </div>

                        <div class="mb-3">
                            <label for="kilo_prix" class="form-label">Prix par kilo</label>
                            <input type="number" step="0.01" class="form-control border border-secondary"
                                id="kilo_prix" name="prix" placeholder="Ex: 2.50, 3.00" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajout Tarif à la course -->
    <div class="modal fade" id="addCourseTarifModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addCourseTarifModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseTarifModalLabel">Nouveau tarif à la course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tarifs.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="course">

                        <div class="mb-3">
                            <label for="course_nom" class="form-label">Nom du tarif</label>
                            <input type="text" class="form-control border border-secondary" id="course_nom"
                                name="nom" placeholder="Ex: Course urbaine" required>
                        </div>

                        <div class="mb-3">
                            <label for="course_prix" class="form-label">Prix fixe</label>
                            <input type="number" step="0.01" class="form-control border border-secondary"
                                id="course_prix" name="prix" placeholder="Ex: 15.00, 20.50" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'édition Tarif -->
    <div class="modal fade" id="editTarifModal" tabindex="-1" aria-labelledby="editTarifModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTarifModalLabel">Modifier le tarif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form id="editTarifForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_tarif_id" name="id">
                        <input type="hidden" id="edit_tarif_type" name="type">

                        <div class="mb-3">
                            <label for="edit_nom" class="form-label">Nom du tarif</label>
                            <input type="text" class="form-control border border-secondary" id="edit_nom"
                                name="nom" required>
                        </div>

                        <div class="mb-3" id="edit_valeur_field">
                            <label for="edit_valeur" class="form-label">Poids (kg)</label>
                            <input type="number" class="form-control border border-secondary" id="edit_valeur"
                                name="valeur">
                        </div>

                        <div class="mb-3">
                            <label for="edit_prix" class="form-label">Prix</label>
                            <input type="number" step="0.01" class="form-control border border-secondary"
                                id="edit_prix" name="prix" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, type, nom, valeur, prix) {
            // Remplir les champs du formulaire
            document.getElementById('edit_tarif_id').value = id;
            document.getElementById('edit_tarif_type').value = type;
            document.getElementById('edit_nom').value = nom;
            document.getElementById('edit_prix').value = prix;

            // Gestion du champ spécifique au type
            const valeurField = document.getElementById('edit_valeur_field');
            const valeurInput = document.getElementById('edit_valeur');

            if (type === 'kilo') {
                valeurField.style.display = 'block';
                valeurInput.value = valeur;
                valeurInput.required = true;
            } else {
                valeurField.style.display = 'none';
                valeurInput.required = false;
            }

            // Mettre à jour l'action du formulaire
            document.getElementById('editTarifForm').action = `/tarif/${id}`;
        }

        // Initialisation des tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    <!-- Modal -->
    @include('tarifs.create')
@endsection
