<aside class="offcanvas offcanvas-start show d-lg-block bg-white border-end" tabindex="-1" id="sidenav-main" aria-labelledby="sidenavLabel" style="width: 260px;">
  <div class="offcanvas-header border-bottom">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/img/logo-ct.png') }}" alt="Logo" width="26" height="26" class="me-2">
      <span class="fw-semibold">GoTrans</span>
    </a>
    <button class="btn-close d-lg-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body d-flex flex-column px-0">
    <nav class="nav flex-column">
      <a class="nav-link px-4 py-2 {{ request()->routeIs('dashboard') ? 'active text-warning fw-semibold bg-light' : 'text-dark' }}" href="{{ route('dashboard') }}">
        <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
      </a>

      <a class="nav-link px-4 py-2 {{ request()->routeIs('dashbord.*') ? 'active text-warning fw-semibold bg-light' : 'text-dark' }}" href="{{ route('dashbord.views') }}">
        <i class="bi bi-graph-up me-2"></i> Overviews
      </a>

      <a class="nav-link px-4 py-2 d-flex align-items-center {{ request()->routeIs('livraison.index') ? 'active text-warning fw-semibold bg-light' : 'text-dark' }}" href="{{ route('livraison.index') }}">
        <i class="bi bi-truck me-2"></i> Livraison
        <span class="badge bg-primary ms-auto">New</span>
      </a>

      <div class="mt-4 px-4 text-uppercase text-muted small">Compte</div>

      <a class="nav-link px-4 py-2 {{ request()->routeIs('profile.*') ? 'active text-warning fw-semibold bg-light' : 'text-dark' }}" href="{{ route('profile.edit') }}">
        <i class="bi bi-person me-2"></i> Mon Profil
      </a>
    </nav>

    <div class="mt-auto px-4 py-3">
      <button class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
      </button>
    </div>
  </div>

  <!-- Modal Déconnexion -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Confirmer la déconnexion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir vous déconnecter ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Se déconnecter</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</aside>
