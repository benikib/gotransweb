<?php

namespace App\Http\Controllers;

use App\Models\Modele_vehicule;
use App\Models\Type_vehicule;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Mockery\Matcher\Type;

use function PHPSTORM_META\type;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicules = Vehicule::all();
        $typeVehicules = Type_vehicule::all();



        return view('vehicule.index', compact('vehicules', 'typeVehicules'));
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
                'immatriculation' => 'required|string|max:255',
                'type_vehicule_id' => 'required|exists:type_vehicules,id',
                
            ]);


            Vehicule::create($request->all());

            return redirect()->back()->with('success', 'Véhicule créé avec succès.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicule $vehicule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicule $vehicule)
    {
        $vehicule = Vehicule::find($vehicule->id);
        if (!$vehicule) {
            return redirect()->route('vehicule.index')->with('error', 'Véhicule non trouvé.');
        }
        $modeleVehicules = Modele_vehicule::all();
        $typeVehicules = Type_vehicule::all();

        return view('vehicule.edit', compact('vehicule', 'typeVehicules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicule $vehicule)
    {

        try {
            $request->validate([
                'immatriculation' => 'required|string|max:255',
                'type_vehicule_id' => 'required|exists:type_vehicules,id',
                'etat' => 'required',
            ]);

            $vehicule->update($request->all());

            return redirect()->route('vehicule.index')->with('success', 'Véhicule mis à jour avec succès.');




        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicule $vehicule)
    {
        try {
            $vehicule->delete();

            return redirect()->route('vehicule.index')->with('success', 'Véhicule supprimé avec succès.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e);
        }
    }
}
