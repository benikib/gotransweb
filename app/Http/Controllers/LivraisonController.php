<?php

namespace App\Http\Controllers;
use App\Models\Livraison;
use App\Models\Livreur;
use App\Models\Type_vehicule;
use App\Models\expedition;
use App\Models\destination;

use App\Models\Vehicule;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\CreateLivraisaonRequest;
use App\Http\Requests\UpdateLivraisonRequest;
use Illuminate\Support\Facades\DB;


class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
    
        return view('livraison.index', [
            'livraisons' => Livraison::all(),
           
            'vehicules' => Vehicule::all(),
             'livreurs' => Livreur::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livraison.create', ["donnees" => [
            'Type_vehicules' => Type_vehicule::all(),
            'vehicules' => vehicule::all(),'clients' => Client::all(),]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLivraisaonRequest $request)
    {
           try {

        $expedition =  Expedition::create([
            'adresse'=> $request->input("adresse_expedition"),
            'tel_expedition'=> $request->input("tel_expedition"),
            'longitude'=> 456.77,
            'latitude'=> 456.7
        ]);

        $destination =  Destination::create([
            'adresse'=> $request->input("adresse_expedition"),
            'tel_expedition'=> $request->input("tel_expedition"),
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
            'kilo_total'=>0,
        ]);

        return redirect()->route('livraison.index')->with('success', 'Livraison created successfully');

     } catch (\Exception $e) {
        dd($e);

            return redirect()->back()->with('error', $e);
        }



        

       
    }

    /**
     * Display the specified resource.
     */
    public function show(Livraison $livraison)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $livraison = Livraison::find($id);
        $Type_vehicules = Type_vehicule::all();
        $clients = Client::all();

        $vehicules = vehicule::all();

        if (!$livraison) {
            return redirect()->route('livraison.index')->with('error', 'Livraison not found');
        }else{
            return view('livraison.edit', [
                'donnees' => compact('livraison', 'Type_vehicules', 'vehicules','clients'),
            ]);;
        }
  
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLivraisonRequest $request)
    {
      
        $livraison = Livraison::find($request->input('id'));
        if (!$livraison) {
            return redirect()->route('livraison.index')->with('error', 'Livraison not found');
        }

        $livraison->update([
            'date' => $request->input('date'),
            'status' => $request->input('status'),
            'code' => $request->input('code'),
            'montant' => $request->input('montant'),
            'client_expediteur_id' => $request->input('client_expediteur_id'),
            'client_destinateur_id' => $request->input('client_destinateur_id'),
            'vehicule_id' => $request->input('id_vehicule'),
            'moyen_transport' => $request->input('moyen_transport'),

        ]);

        return redirect()->route('livraison.index')->with('success', 'Livraison updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        
        $livraison = Livraison::find($id);
        if (!$livraison) {
            return redirect()->route('livraison.index')->with('error', 'Livraison not found');
        }
        $livraison->delete();

        return redirect()->route('livraison.index')->with('success', 'Livraison deleted successfully');
    }

    public function changeStatus($id)
    {

        $livraison = Livraison::find($id);

        $etat= $livraison->status;
        if ($etat == 'en_attente') {
            $livraison->status = 'en_cours';
        } elseif ($etat == 'en_cours') {
            $livraison->status = 'livree';
        } elseif ($etat == 'livree') {
            $livraison->status = 'annulee';
        } else {
            $livraison->status = 'en_attente';
        }
        $livraison->save();

        return  redirect()->route('livraison.index')->with('success', 'Livraison edit successfully');
    }

    public function affectation( $id)
    {
        $types = Type_vehicule::all(); // Récupère tous les types

        return response()->json([
            'status' => 'success',
             'id' =>$id,
            'message' => 'Livraison affectée avec succès.',
            'data' => $types // Envoie les types dans la réponse
        ]);

    }

    public function selectAffectation($id)
        {
            $vehiculesLibres = DB::table('vehicules')
                ->leftJoin('livraisons', 'vehicules.id', '=', 'livraisons.vehicule_id')
                ->where(function ($query) {
                    $query->whereNull('livraisons.id')
                        ->orWhere('livraisons.status', '=', 'validee');
                })
                ->select('vehicules.id as vehicule_id', 'livraisons.id as livraison_id') // <- ici on injecte $id
                ->select('vehicules.*')
                 ->where('vehicules.type_vehicule_id', '=', $id)
                ->groupBy('vehicules.id')
                ->get();
               

              

            return response()->json([
                'status' => 'success',
                'message' => 'Véhicules libres',
                
                'data' => $vehiculesLibres
            ]);
        }


     public function saveAffectation( Request $request)

        {
        
            $livraison = Livraison::find($request->input('id_livraison'));
            if (!$livraison) {
                return redirect()->route('livraison.index')->with('error', 'Livraison not found');
            }

            $livraison->update([
                'vehicule_id' => $request->input('vehicule_id'),
                'status' => "en_cours",
            ]);
            return redirect()->route('livraison.index')->with('success', 'Livraison updated successfully');
        }

        
     public function selectLivreur($id )

        {
          

            $vehiculesAvecLivreurs = DB::table('vehicules')
                ->join('livreur__vehicules', 'vehicules.id', '=', 'livreur__vehicules.vehicule_id')
                ->join('livreurs', 'livreur__vehicules.livreur_id', '=', 'livreurs.id')
                ->join('users', 'users.id', '=', 'livreurs.user_id')

                ->where('livreur__vehicules.vehicule_id', '=', $id)
                ->select(
                    'livreurs.id as livreur_id',
                    'users.name as livreur_name',
                    'users.number_phone as livreur_telephone',
                    'users.email as livreur_email'
                   
                )
                ->get();
                

                 return response()->json([
                'status' => 'success',
                'message' => 'livreurs affectés',
                'data' =>  $vehiculesAvecLivreurs
            ]);

        }

        
   


}
