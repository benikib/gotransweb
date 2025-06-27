<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarifs = Tarif::all();

        return view('tarifs.index', compact('tarifs'));
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
        $request->validate([
            'kilo_tarif' => 'required|integer',
            'prix_tarif' => 'required|integer',
            'nom' => 'required|string|max:255'
        ]);

        Tarif::create($request->all());

        return redirect()->back()->with('success', 'Tarif created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarif $tarif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarif $tarif)
    {
        return view('tarifs.edit', compact('tarif'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Tarif $tarif)
    // {
    //     $request->validate([
    //         'kilo_tarif' => 'required|integer',
    //         'prix_tarif' => 'required|integer',
    //     ]);

    //     $tarif->update([
    //         'kilo_tarif' => $request->input('kilo_tarif'),
    //         'prix_tarif' => $request->input('prix_tarif'),
    //     ]);

    //     return redirect()->route('tarifs.index')->with('success', 'Tarif modifié avec succès.');
    // }

public function update(Request $request, Tarif $tarif)
{
    // ✅ Étape 1 : Validation des données
    $validated = $request->validate([
        'kilo_tarif' => 'required|integer|min:1',
        'prix_tarif' => 'required|integer|min:0',
    ]);

    // ✅ Étape 2 : Mise à jour des données
    $tarif->update($validated);

    // ✅ Étape 3 : Si c’est un appel AJAX (modal), retourne du JSON
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Tarif mis à jour avec succès.',
            'tarif' => $tarif
        ]);
    }

    // ✅ Étape 4 : Sinon, comportement normal
    return redirect()
        ->route('tarifs.index')
        ->with('success', 'Tarif modifié avec succès.');

}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarif $tarif)
    {
        $tarif->delete();

        return redirect()->back()->with('success', 'Tarif deleted successfully.');
    }
}
