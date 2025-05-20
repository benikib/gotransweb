@extends('layouts.base')
@section('title', 'Mon compte')
@section('content')

    <!-- Contenu principal -->
    
   
            <h1 class="mb-4">Mon compte</h1>
            <div class="row g-4">

                <!-- Formulaire de mise à jour des infos -->
                <div class="container-fluid py-2">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-semibold">Informations du profil</div>
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Formulaire de changement de mot de passe -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-semibold">Changer le mot de passe</div>
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Formulaire de suppression de compte -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-semibold text-danger">Supprimer mon compte</div>
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
       
@endsection

