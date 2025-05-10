<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
  id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand px-4 py-3 m-0" href="{{ route('dashbord.views') }}">
      <img src="{{ asset('assets/img/logo.png') }}" class="navbar-brand-img" width="26" height="26" alt="logo">
      <span class="ms-1 text-sm text-dark">GoTrans</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0 mb-2">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashbord.views') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
          href="{{ route('dashbord.views') }}">
          <i class="material-symbols-rounded opacity-5">dashboard</i>
          <span class="nav-link-text ms-1">Tableau de bord</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashbord.views.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
          href="{{ route('dashbord.views') }}">
          <i class="material-symbols-rounded opacity-5">directions_car</i>
          <span class="nav-link-text ms-1">Mes Trajets</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashbord.views.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
          href="{{ route('dashbord.views') }}">
          <i class="material-symbols-rounded opacity-5">event_seat</i>
          <span class="nav-link-text ms-1">Mes Réservations</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashbord.views.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
          href="{{ route('dashbord.views') }}">
          <i class="material-symbols-rounded opacity-5">chat</i>
          <span class="nav-link-text ms-1">Messages</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Compte</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('profile.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
          href="{{ route('profile.edit') }}">
          <i class="material-symbols-rounded opacity-5">person</i>
          <span class="nav-link-text ms-1">Mon Profil</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('vehicules.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
          href="{{ route('vehicule.index') }}">
          <i class="material-symbols-rounded opacity-5">directions_car_filled</i>
          <span class="nav-link-text ms-1">Mes Véhicules</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashbord.views.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
          href="{{ route('dashbord.views') }}">
          <i class="material-symbols-rounded opacity-5">payments</i>
          <span class="nav-link-text ms-1">Paiements</span>
        </a>
      </li>
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a class="nav-link text-dark" href="{{ route('logout') }}"
            onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="material-symbols-rounded opacity-5">logout</i>
            <span class="nav-link-text ms-1">Déconnexion</span>
          </a>

        </form>
      </li>
    </ul>
  </div>
</aside>
