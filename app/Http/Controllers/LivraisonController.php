<?php

namespace App\Http\Controllers;
use App\Models\Livraison;
use Illuminate\Http\Request;
use Illuminate\View\View;


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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Livraison $livraison)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livraison $livraison)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livraison $livraison)
    {
        //
    }
}
