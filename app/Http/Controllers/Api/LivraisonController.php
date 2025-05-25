<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use App\Models\Expedition;
use App\Models\Destination;
use App\Http\Resources\LivraisonResource;
use App\Http\Resources\ExpeditionResource;
use Illuminate\Http\Request;
use App\Models\Vehicule;
use App\Models\Livreur;
use Illuminate\Support\Facades\DB;

class LivraisonController extends Controller
{
    public function index()

    {
       
    }

    public function getLivraisonExpediteur($idClient)
    {
        $livraison = Livraison::where('client_expediteur_id', $idClient)->get();
        
        return LivraisonResource::collection($livraison);
    }

    public function getLivraisonDestinateur($idClient)
    {
        $livraison = Livraison::where('client_destinateur_id', $idClient)->get();
        
        return LivraisonResource::collection($livraison);
    }




    public function showLivraisonLivreur($idLivreur,$idLivraison)
    {
        $livraisons = DB::table('livraisons')
            ->leftJoin('vehicules as v', 'livraisons.vehicule_id', '=', 'v.id')
            ->leftJoin('livreur__vehicules as lv', 'lv.vehicule_id', '=', 'v.id')
            ->leftJoin('livreurs', 'lv.livreur_id', '=', 'livreurs.id')
            ->leftJoin('expeditions', 'expeditions.id', '=', 'livraisons.expedition_id')
            ->leftJoin('destinations', 'destinations.id', '=', 'livraisons.destination_id')
    
            ->leftJoin('clients as exp', 'exp.id', '=', 'livraisons.client_expediteur_id')
            ->leftJoin('clients as dest', 'dest.id', '=', 'livraisons.client_destinateur_id')
        
            // Joindre les utilisateurs liés aux clients
            ->leftJoin('users as user_exp', 'user_exp.id', '=', 'exp.user_id')
            ->leftJoin('users as user_dest', 'user_dest.id', '=', 'dest.user_id')
            ->leftJoin('users as user_livreur', 'user_livreur.id', '=', 'livreurs.user_id')
    
            ->where('livreurs.id', '=', $idLivreur)
            ->where('livraisons.id', '=', $idLivraison) // ← condition ici
            ->select(
                'livraisons.id as id_livraison ',
                'v.id as vehicule_id',
                'v.immatriculation as immatriculation',
                'livreurs.id as livreur_id',
    
                'user_exp.name as nom_expediteur',
                'user_dest.name as nom_destinateur',
                'user_livreur.name as nom_livreur',
              
                'expeditions.adresse as adresse_expedition',
                'expeditions.tel_expedition as tel_expedition',
               
                'destinations.adresse as adresse_destination',
                'destinations.tel_destination as tel_destination',

            )
            ->get();
    
        return response()->json([
            'message' => 'Livraisons du livreur récupérées avec succès',
            'data' => $livraisons
        ]);
    }




    public function getLivraisonLivreur($idLivreur)
{
    $livraisons = DB::table('livraisons')
        ->leftJoin('vehicules as v', 'livraisons.vehicule_id', '=', 'v.id')
        ->leftJoin('livreur__vehicules as lv', 'lv.vehicule_id', '=', 'v.id')
        ->leftJoin('livreurs', 'lv.livreur_id', '=', 'livreurs.id')
        ->leftJoin('expeditions', 'expeditions.id', '=', 'livraisons.expedition_id')
        ->leftJoin('destinations', 'destinations.id', '=', 'livraisons.destination_id')

        ->leftJoin('clients as exp', 'exp.id', '=', 'livraisons.client_expediteur_id')
        ->leftJoin('clients as dest', 'dest.id', '=', 'livraisons.client_destinateur_id')
    
        // Joindre les utilisateurs liés aux clients
        ->leftJoin('users as user_exp', 'user_exp.id', '=', 'exp.user_id')
        ->leftJoin('users as user_dest', 'user_dest.id', '=', 'dest.user_id')
        ->leftJoin('users as user_livreur', 'user_livreur.id', '=', 'livreurs.user_id')
       

        ->where('livreurs.id', '=', $idLivreur) // ← condition ici
        ->select(
            'livraisons.id as id_livraison',
            'livraisons.date as date',
            'livraisons.status as status',
            'v.id as vehicule_id',
            'v.immatriculation as immatriculation',
            'livreurs.id as livreur_id',

            'user_exp.name as nom_expediteur',
            'user_dest.name as nom_destinateur',
            'user_livreur.name as nom_livreur',
          
            'expeditions.id as exp',
           
            'destinations.id as des'
        )
        ->get();

    return response()->json([
        'message' => 'Livraisons du livreur récupérées avec succès',
        'data' => $livraisons
    ]);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

          $expedition =  Expedition::create([
              'adresse'=> $request->input("adresse_expedition"),
              'tel_expedition'=> $request->input("tel_expedition"),
              'longitude'=> 456.77,
              'latitude'=> 456.7
          ]);

          $destination =  Destination::create([
              'adresse'=> $request->input("adresse_destination"),
              'nom_destination'=> $request->input("nom_destination"),
              'tel_destinations'=> $request->input("tel_destination"),
              'longitude'=> 458.7,
              'latitude'=> 456.7
          ]);
        

          $livraison = Livraison::create([
              'date' => $request->input('date'),
              'status' => $request->input('status'),
              'code' => $request->input('code'),
              'montant' => $request->input('montant'),
              'client_expediteur_id' => $request->input('client_expediteur_id'),
              'client_destinateur_id' => $request->input('client_destinateur_id'),
              'destination_id' => $destination->id,
              'expedition_id' => $expedition->id,
              'moyen_transport' => $request->input('moyen_transport'),
              'vehicule_id' => 0,
              'kilo_total'=>$request->input('Kilo_total')
          ]);

          return response()->json(['message' => 'demande de livraison envoyer avec succes']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $livraison = Livraison::find($id);
        if ($livraison) {
            return new LivraisonResource($livraison);
        } else {
            return response()->json(['message' => 'Livraison not found'], 404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $livraison = Livraison::find($request->input('id'));
     
         $livraison->update([
           
            'montant' => $request->input('montant'),
            'kilo_total' => $request->input('kilo_total'),
            'status' => "en_cours",
          
        ]);

        return response()->json(['message' => 'Livraison updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancel($id)
    {
         $livraison = Livraison::find($id);
     
         $livraison->update([

            'status' => "annulee",
          
        ]);

        return response()->json(['message' => 'Livraison annulee successfully']);
    }

     public function en_cours(string $id,string $montant,string $poid)
    {
        // confirmer les information du livreur poid et montant recu et changer le status en en_cours
       $livraison = Livraison::find($id);
     
         $livraison->update([

            'status' => "en_cours",
            'montant' => "5555555",
            'poid' => "44454",
          
        ]);

        return response()->json(['message' => 'Livraison ok ']);
    }

    public function terminer(string $id,string $codeLivraison)
    {
        // verifiction si le code correspond avant de passer la status a terminee
       $livraison = Livraison::find($id);
     
         $livraison->update([

            'status' => "terminee",
          
        ]);

        return response()->json(['message' => 'Livraison ok ']);
    }
}
