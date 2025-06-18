
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <style>
.card.card-custom {
  background-color: #ffffff !important;
  box-shadow: none !important;
  border: 1px solid #ddd; /* optionnel, pour une délimitation nette */
}
    .card-custom {
        border-radius: 10px;
        padding: 20px;
        margin: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: fadeIn 0.5s ease-in-out;
    }

    .card-custom:hover {
        transform: translateY(-5px);
    }

    .card-title {
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }

    .card-value {
        font-size: 2rem;
        font-weight: 700;
        color: #343a40;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .hover-scale {
  transition: transform 0.2s ease;
}
.hover-scale:hover {
  transform: scale(1.02);
}

</style>
  <title>
    @yield('title')
  </title>
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/charts/chart-3/assets/css/chart-3.css">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css" rel="stylesheet')}}" />
  <link href="{{asset('assets/css/nucleo-svg.css" rel="stylesheet')}}" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/material-dashboard.css?v=3.2.0')}}" rel="stylesheet" />
   @vite(['resources/sass/app.scss', 'resources/js/app.js'])
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


</head>

<body class="g-sidenav-show  bg-gray-100">
 @include('layouts.headerBase')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
   @include('layouts.navbase')


   @yield('content')


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
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://unpkg.com/bs-brain@2.0.4/components/charts/chart-3/assets/controller/chart-3.js"></script>
</body>
</html>
