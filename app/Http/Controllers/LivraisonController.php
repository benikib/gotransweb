<?php

namespace App\Http\Controllers;
use App\Models\Livraison;
use App\Models\Type_vehicule;
use App\Models\expedition;
use App\Models\destination;

use App\Models\vehicule;
use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\CreateLivraisaonRequest;
use App\Http\Requests\UpdateLivraisonRequest;


class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
    
        return view('livraison.index', [
            'livraisons' => Livraison::all()
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
}
