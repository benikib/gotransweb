<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use App\Models\Livreur_Vehicule;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class LivreurVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livreurVehicules = Livreur_Vehicule::all();
        $vehicules = $vehiculesDisponibles = Vehicule::doesntHave('livreurs')->get();

        $livreurs = $livreursDisponibles = Livreur::doesntHave('vehicules')->get();

        return view('livreurVehicule.index', compact('livreurVehicules', 'vehicules', 'livreurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'livreur_id' => 'required|exists:livreurs,id',
                'vehicule_id' => 'required|exists:vehicules,id',
            ]);

            Livreur_Vehicule::create($request->all());

            return redirect()->route('livreurVehicule.index')->with('success', 'Affectation créée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur de validation.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Livreur_Vehicule $livreur_Vehicule)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livreur_Vehicule $livreur_Vehicule)
    {
        $livreurVehicule = Livreur_Vehicule::find($livreur_Vehicule->id);
        $vehicules = $vehiculesDisponibles = Vehicule::doesntHave('livreurs')->get();

        $livreurs = $livreursDisponibles = Livreur::doesntHave('vehicules')->get();
        if (!$livreur_Vehicule) {
            return redirect()->route('livreurVehicule.index')->with('error', 'Affectation non trouvée.');
        }
        return view('livreurVehicule.edit', compact('livreurVehicule', 'vehicules', 'livreurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livreur_Vehicule $livreur_Vehicule)
    {
        $request->validate([
            'livreur_id' => 'required|exists:livreurs,id',
            'vehicule_id' => 'required|exists:vehicules,id',
        ]);

        $livreur_Vehicule->update($request->all());

        return redirect()->back()->with('success', 'Affectation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livreur_Vehicule $livreur_Vehicule)
    {
        $livreur_Vehicule->delete();

        return redirect()->route('livreurVehicule.index')->with('success', 'Affectation supprimée avec succès.');
    }
}
