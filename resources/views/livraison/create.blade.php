@extends("layouts.base")
@section('title', 'creation livraison')
@section('content') 

<div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
       
          <div class="col-lg-12 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
           
              <div class="card-body">
                <form role="form" method="post" action="{{route('livraison.store')}}" class="text-start">
                    @csrf
                <div class="row">
                    <div class="col"> 
                        <label class="form-label">Code de livraison</label>
                        <div class="input-group input-group-outline ">
                            <input type="text"  name="code" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col">
                        <label class="form-label">Kilo total</label>
                        <div class="input-group input-group-outline ">
                            <input type="text"   name="Kilo_total" value="" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col"> 
                        <label class="form-label">Moyen tansport</label>
                        <div class="input-group input-group-outline " >
                        <select id="status" name="moyen_transport" class="form-control">
                                <option value="moto" >moto</option>
                                <option value="mini_voiture" >mini voiture</option>
                                <option value="moyen_voiture" >moyen voiture</option>
                                <option value="grand_voiture" >grand voiture</option>
                        </select>
                        </div>
                    </div>

                    <div class="col">
                        <label class="form-label">Montant</label>
                        <div class="input-group input-group-outline ">
                            <input type="text"   name="montant" value="" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                
                    <div class="col"> 
                        <label class="form-label">Status</label>
                        <div class="input-group input-group-outline " >
                            <select id="status"  name="status" class="form-control">
                                
                                    <option value="livree" >livree</option>
                                    <option value="en_attente" selected>en_attente</option>
                                    <option value="annulee" >annulee</option>
                                    <option value="en_cours" >en_cours</option>
                                
                            </select>
                           
                        </div>
                    </div>

                    <div class="col">
                        <label class="form-label">Date de livraison</label>
                        <div class="input-group input-group-outline ">
                            <input type="date"  name="date" value="" class="form-control">
                        </div>
                    </div>
                </div>

                

                <fieldset class="border p-3 mb-4 mt-3">
                    <legend class="w-auto px-2">Information destination </legend>

                    <div class="row">
                        <div class="col">
                        
                            <label for="id_type_vehicule" class="form-label">Adresse</label>
                            <div class="input-group input-group-outline">
                                <input type="text"  name="adresse_destination" value="" class="form-control">
                            
                            </div>
                        </div>

                        <div class="col">
                            <label for="id_vehicule" class="form-label">Telephone</label>
                            <div class="input-group input-group-outline">
                                <input type="text" name="tel_destination"   name="date" value="" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="client" class="form-label">Client(Destinateur)</label>
                                <div class="input-group input-group-outline">
                                    <select id="id_client_destinateur" name="client_destinateur_id" class="form-control">
                                        @foreach ($donnees['clients'] as $client)
                                            <option value="{{ $client->id }}" >{{ $client->User->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="border p-3 mb-4">
                    <legend class="w-auto px-2">Information sur l'expedition </legend>

                    <div class="row">
                        
                        <div class="col">
                            
                            <label for="" class="form-label">Adresse</label>
                            <div class="input-group input-group-outline">
                                <input type="text"  name="adresse_expedition" value="" class="form-control">
                            
                            </div>
                        </div>

                        <div class="col">
                            <label for="" class="form-label">telephone</label>
                            <div class="input-group input-group-outline">
                            <input type="text"  name="tel_expedition" value="" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                            <div class="col">
                                <label for="client" class="form-label">Client(Expediteur)</label>
                                <div class="input-group input-group-outline">
                                    <select id="client" name="client_expediteur_id" class="form-control">
                                        @foreach ($donnees['clients'] as $client)
                                            <option value="{{ $client->id }}" >{{ $client->User->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                    </div>
                </fieldset>

                 
                 
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Enregistrer</button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
              <div class="copyright text-center text-sm text-white text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart" aria-hidden="true"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold text-white" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-12 col-md-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-white" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-white" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-white" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-white" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>


@endsection