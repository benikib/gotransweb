<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
  id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand px-4 py-3 m-0" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img" width="26" height="26" alt="logo">
      <span class="ms-1 text-sm text-dark">GoTrans</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0 mb-2">
  
 <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item mb-1">
        <a class="nav-link py-2 px-3 {{ request()->routeIs('dashboard') ? 'active bg-light text-primary border-start border-primary border-3' : 'text-dark opacity-8' }}" 
           href="{{ route('dashboard') }}">
          <div class="d-flex align-items-center">
            <i class="material-symbols-rounded me-3">dashboard</i>
            <span class="nav-link-text">Tableau de bord</span>
          </div>
        </a>
      </li>
      
      <!-- Autres éléments du menu -->
      <li class="nav-item mb-1">
        <a class="nav-link py-2 px-3 {{ request()->routeIs('dashbord.*') ? 'active bg-light text-primary border-start border-primary border-3' : 'text-dark opacity-8' }}" 
           href="{{ route('dashbord.views') }}">
          <div class="d-flex align-items-center">
            <i class="material-symbols-rounded me-3">summarize</i>
            <span class="nav-link-text">Overviews</span>
          </div>
        </a>
      </li>
      
      <li class="nav-item mb-1">
        <a class="nav-link py-2 px-3 {{ request()->routeIs('livraison.index') ? 'active bg-light text-primary border-start border-primary border-3' : 'text-dark opacity-8' }}" 
           href="{{ route('livraison.index') }}">
          <div class="d-flex align-items-center">
            <i class="material-symbols-rounded me-3">event_seat</i>
            <span class="nav-link-text">Livraison</span>
            <span class="badge bg-primary ms-auto">New</span>
          </div>
        </a>
      </li>
      
      <!-- Section compte -->
      <li class="nav-item mt-3 mb-1">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-muted font-weight-bolder">Compte</h6>
      </li>
      
      <li class="nav-item mb-1">
        <a class="nav-link py-2 px-3 {{ request()->routeIs('profile.*') ? 'active bg-light text-primary border-start border-primary border-3' : 'text-dark opacity-8' }}" 
           href="{{ route('profile.edit') }}">
          <div class="d-flex align-items-center">
            <i class="material-symbols-rounded me-3">person</i>
            <span class="nav-link-text">Mon Profil</span>
          </div>
        </a>
      </li>
      
      <!-- Autres éléments... -->
    </ul>
    
    <!-- Bouton Déconnexion -->
    <div class="mt-auto px-3 py-3">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-light text-danger d-flex align-items-center w-100 py-2 px-3 rounded" 
                type="submit">
          <i class="material-symbols-rounded me-2">logout</i>
          <span>Déconnexion</span>
        </button>
      </form>
    </div>
  </div>
<style>
.nav-link {
  transition: all 0.2s ease;
  border-radius: 0.25rem;
}

.nav-link:hover:not(.active) {
  background-color: rgba(0,0,0,0.03);
  transform: translateX(2px);
}

.active {
  font-weight: 500;
}

.sidenav {
  transition: all 0.3s ease;
}
</style>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const iconSidenav = document.getElementById("iconSidenav");
    const sidenav = document.getElementById("sidenav-main");

    if (iconSidenav && sidenav) {
      iconSidenav.addEventListener("click", function () {
        sidenav.classList.toggle("g-sidenav-hidden");
      });
    }
  });
</script>

</aside>
