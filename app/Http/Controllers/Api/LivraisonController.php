<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use App\Models\Expedition;
use App\Models\Destination;
use App\Http\Resources\LivraisonResource;
use App\Http\Resources\ExpeditionResource;
use Illuminate\Http\Request;

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
              'tel_expedition'=> $request->input("tel_destination"),
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
    public function cancel( $id)
    {
         $livraison = Livraison::find($id);
     
         $livraison->update([

            'status' => "annulee",
          
        ]);

        return response()->json(['message' => 'Livraison annulee successfully']);
    }

     public function finish(string $id)
    {
       $livraison = Livraison::find($id);
     
         $livraison->update([

            'status' => "validee",
          
        ]);

        return response()->json(['message' => 'Livraison ok ']);
    }
}
