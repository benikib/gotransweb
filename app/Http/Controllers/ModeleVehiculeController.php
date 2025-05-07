<?php

namespace App\Http\Controllers;

use App\Models\Modele_vehicule;
use App\Models\Type_vehicule;
use Illuminate\Http\Request;
use Mockery\Matcher\Type;

class ModeleVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modeleVehicules = Modele_vehicule::all();

        //$typeVehicules = Modele_vehicule::with('type_vehicule')->get();

        return view('modeleVehicule.index', compact('modeleVehicules'));
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
                'nom_modele' => 'required|string|max:255',

                'tarif' => 'required|numeric|min:0',
            ]);

            Modele_vehicule::create($request->all());

            return redirect()->route('modelevehicule.index')->with('success', 'Modèle de véhicule créé avec succès.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Modèle de véhicule non trouvé.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Modele_vehicule $modele_vehicule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modele_vehicule $modele_vehicule)
    {
        $modeleVehicule = Modele_vehicule::find($modele_vehicule->id);
        if (!$modele_vehicule) {
            return redirect()->route('modelevehicule.index')->with('error', 'Modèle de véhicule non trouvé.');
        }
        return view('modeleVehicule.edit', compact('modeleVehicule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modele_vehicule $modele_vehicule)
    {
        $request->validate([
            'nom_modele' => 'required|string|max:255',
            'tarif' => 'required|numeric|min:0',
        ]);

        $modele_vehicule->update($request->all());

        return redirect()->route('modelevehicule.index')->with('success', 'Modèle de véhicule mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modele_vehicule $modele_vehicule)
    {
        $modele_vehicule->delete();

        return redirect()->route('modelevehicule.index')->with('success', 'Modèle de véhicule supprimé avec succès.');
    }
}
