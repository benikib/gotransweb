<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use App\Models\Type_vehicule;
use Illuminate\Http\Request;

class TypeVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeVehicules = Type_vehicule::all();
        $tarifs = Tarif::all();

        return view('typeVehicule.index', compact('typeVehicules','tarifs'));
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
        try{
        $request->validate([
            'nom_type' => 'required|string|max:255',
            'kilo_initiale'=> 'required',
            'tarif_id'  => 'required',
            'kilo_final'=> 'required',
            'description'=>'required'

        ]);

        Type_vehicule::create($request->all());

        return redirect()->back()->with('success', 'Type de véhicule créé avec succès.');
        }
        catch (\Exception $e) {


            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Type_vehicule $type_vehicule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type_vehicule $type_vehicule)
    {
        $typeVehicule = Type_vehicule::find($type_vehicule->id);
        $tarifs = Tarif::all();
        if (!$type_vehicule) {
            return redirect()->back()->with('error', 'Type de véhicule non trouvé.');
        }
        return view('typeVehicule.edit', compact('typeVehicule','tarifs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type_vehicule $type_vehicule)
    {
        $request->validate([
            'nom_type' => 'required|string|max:255',
            'tarif_id'  => 'required'
        ]);


        $type_vehicule->update($request->all());

        return redirect()->route('dashbord.views')->with('success', 'Type de véhicule mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type_vehicule $type_vehicule)
    {
        $type_vehicule->delete();

        return redirect()->back()->with('success', 'Type de véhicule supprimé avec succès.');
    }
}
