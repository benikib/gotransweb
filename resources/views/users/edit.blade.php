<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <title>
    @yield('title')
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/material-dashboard.css?v=3.2.0')}}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  @include('layouts.headerBase')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layouts.navbase')

    <!-- Formulaire affiché directement -->
    <div class="container mt-5">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
          <h5 class="mb-0">Modifier un utilisateur</h5>
        </div>
        <div class="card-body px-4 py-4">
          <form action="" method="POST">
            @csrf

            <div class="mb-3">
              <label for="firstname" class="form-label fw-bold">Nom</label>
              <input type="text" class="form-control"name='name' id="firstname" value="{{old('nom',$use->name)}} "required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label fw-bold">Email</label>
              <input type="email" class="form-control " name="email" id="email" em value="{{old('email',$use->email)}}" required>
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label fw-bold">Téléphone (facultatif)</label>
              <input type="tel" class="form-control" name="number_phone" id="phone" value="{{old('number_phone',$use->number_phone)}}">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label fw-bold">Mot de passe</label>
              <input type="password" class="form-control" id="password" name="password" value="{{old('password',$use->password)}}" required>
            </div>

            {{-- <div class="mb-4">
              <label for="role" class="form-label fw-bold">Rôle</label>
              <select class="form-select rounded-3" name="role" id="role" required>
                <option value="">-- Sélectionnez un rôle --</option>
                <option value="admin">Admin</option>
                <option value="client">Client</option>
                <option value="livreur">Livreur</option>
              </select>
            </div> --}}

            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary rounded-3">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </main>

  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

</body>

</html>
