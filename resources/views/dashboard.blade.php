@extends('layouts.base')

@section('title', 'Dashboard')

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

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 d-flex justify-content-between align-items-center bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 px-3">
                    <h6 class="text-white text-capitalize m-0">Type de Vehicule</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ajouter type de vehicule
                    </button>
                </div>
                <!-- Modal and card body here -->
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Authors table</h6>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <!-- Table content... -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Projects table</h6>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <!-- Table content... -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer py-4">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item"><a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a></li>
                        <li class="nav-item"><a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a></li>
                        <li class="nav-item"><a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a></li>
                        <li class="nav-item"><a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
@endsection