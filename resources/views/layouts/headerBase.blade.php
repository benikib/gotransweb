
<button type="button" id="iconNavbarSidenav" class="d-none btn btn-outline-primary mx-3 my-3  shadow-sm p-3 py-2">
  <i class="bi bi-list fs-3"></i>
</button>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2 transition"
  id="sidenav-main">

 <div class="sidenav-header d-flex justify-content-between align-items-center px-4 py-3">
  <a class="navbar-brand m-0" href="{{ route('dashboard') }}">
    <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img" width="26" height="26" alt="logo">
    <span class="ms-1 text-sm text-dark sidenav-label">GoTrans</span>
  </a>
  
  <button type="button" id="iconSidenav" class="d-none btn btn-outline-primary  shadow-sm p-2">
  X
</button>


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
  <span class="nav-link-text me-2">Livraison</span>
  <span id="nombre" class="badge bg-danger ms-auto"></span>
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
  <button class="btn btn-light text-danger d-flex align-items-center w-100 py-2 px-3 rounded"
          data-bs-toggle="modal" data-bs-target="#logoutModal">
    <i class="material-symbols-rounded me-2">logout</i>
    <span>Déconnexion</span>
  </button>
</div>

  </div>
  <!-- Modal de confirmation de déconnexion -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">

      <div class="modal-header bg-danger text-white rounded-top-4">
        <h5 class="modal-title" id="logoutModalLabel">
          <i class="bi bi-box-arrow-right me-2"></i>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      <div class="modal-body text-center fs-5 py-4">
        <p class="mb-0">Êtes-vous sûr de vouloir vous déconnecter ?</p>
      </div>

      <div class="modal-footer justify-content-center border-0 pb-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger px-4">Confirmer</button>
        </form>
      </div>

    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
  

 

  function LivraisonModal() {
   

    const nombre = document.getElementById('nombre');
      $.ajax({
          url: "{{ route('livraison.getLivraisonLine') }}",
          type: "GET",
          success: function (data) {

            if (data.data && typeof data.data.nombre !== 'undefined') {
  
    nombre.innerHTML = data.data[0].nombre;
  } else {
    console.warn("Donnée invalide ou manquante :", data);
  }

         
            
            
             
          },
          error: function (xhr, status, error) {
              console.error('Erreur :', error);
          }
      });
  }
  setInterval(() => {
    LivraisonModal();
}, 1000); 
// showLivraisonModal();

  // let affiche = showLivraisonModal();
  // let affiches = JSON.parse(affiche);
  // console.log(affiches);
</script>


</aside>
