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
        //ici j'affiche les informations du livraison en fonction de l'expediteur
        $livraisons = Livraison::with(['Destination', 'Expedition','expediteur.user','destinateur.user'
        ,'Vehicule.livreurs.vehicule','Vehicule.livreurs.livreur.user','Vehicule.type_vehicule.tarif'])->where('client_expediteur_id', $idClient)->get();

        return LivraisonResource::collection($livraisons);
    }

    public function getLivraisonDestinateur($idClient)
    {
     //ici j'affiche les informations du livraison en fonction du destinateur
        $livraisons = Livraison::with(['Destination', 'Expedition','expediteur.user','destinateur.user'
        ,'Vehicule.livreurs.vehicule','Vehicule.livreurs.livreur.user','Vehicule.type_vehicule.tarif'])->where('client_destinateur_id', $idClient)->get();

        
        return LivraisonResource::collection($livraisons);
    }


    public function showLivraisonLivreur($idLivreur,$idLivraison)
    {
        $livraisons = Livraison::with([
            'Expedition',
            'Destination',
            'expediteur.user',
            'destinateur.user',
            'Vehicule.livreurs.livreur.user',
            'Vehicule.type_vehicule.tarif'
        ])
        ->where('id', $idLivraison)
        ->whereHas('Vehicule.livreurs', function ($query) use ($idLivreur) {
            $query->where('livreur_id', $idLivreur);
        })
        ->get();
    
        return LivraisonResource::collection($livraisons);
    }





    public function getLivraisonLivreur($idLivreur)
    {
        // Récupérer les livraisons assignées au livreur
        $livraisons = Livraison::with([
            'Expedition',
            'Destination',
            'expediteur.user',
            'destinateur.user',
            'Vehicule.livreurs',
            'Vehicule.livreurs.livreur.user',
            'Vehicule.type_vehicule.tarif'
        ])
        ->whereHas('Vehicule.livreurs', function ($query) use ($idLivreur) {
            $query->where('livreur_id', $idLivreur);
        })
        ->get();

        return LivraisonResource::collection($livraisons);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       

          $expedition =  Expedition::create([
              'adresse'=> $request->input("adresse_expedition"),
              'tel_expedition'=> $request->input("tel_expedition"),
              'longitude'=> $request->input("longitude_expedition"),
              'latitude'=> $request->input("latitude_expedition")
          ]);

          $destination =  Destination::create([
              'adresse'=> $request->input("adresse_destination"),
              'nom_destination'=> $request->input("nom_destination"),
              'tel_destinations'=> $request->input("tel_destination"),
              'longitude'=> $request->input("longitude_destination"),
              'latitude'=> $request->input("latitude_destination")
          ]);
          return response()->json(['erreur' => $request->all()]);

          $livraison = Livraison::create([
              'date' => $request->input('date'),
              'status' => "en_attente",
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

     public function en_cours(Request $request)
    {
        // confirmer les information du livreur poid et montant recu et changer le status en en_cours
       $livraison = Livraison::find($request->input("id"));
     
      $livraison->update([

            'status' => "en_cours",
            'montant' =>$request->input("montant"),
             'kilo_total' =>$request->input("poid"),
          
         ]);

        return response()->json(['message' => 'Livraison ok ','data'=>[$request->input("id"),$request->input("montant"),
        $request->input("poid")
        ]]);
    }

    public function terminer(Request $request)
    {
        // Recherche de la livraison
        $livraison = Livraison::find($request->input("id"));
    
        // Vérifier si la livraison existe
        if (!$livraison) {
            return response()->json([
                'message' => 'Livraison introuvable'
            ], 404);
        }
    
        // Vérifier que le code correspond
        if ($livraison->code !== $request->input("codeLivraison")) {
            return response()->json([
                'message' => 'Code de livraison incorrect'
            ], 400);
        }
    
        // Mettre à jour le statut
        $livraison->update([
            'status' => 'terminee',
        ]);
    
        return response()->json([
            'message' => 'Livraison terminée avec succès'
        ], 200);
    }
    
}
