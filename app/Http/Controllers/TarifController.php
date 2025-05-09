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
        ]);

        Tarif::create($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif created successfully.');    
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
    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'kilo_tarif' => 'required|integer',
            'prix_tarif' => 'required|integer',
        ]);

        $tarif->update($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarif $tarif)
    {
        $tarif->delete();

        return redirect()->route('tarifs.index')->with('success', 'Tarif deleted successfully.');
    }
}
