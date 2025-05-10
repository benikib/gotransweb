<?php

namespace App\Http\Controllers;
use App\Models\Livraison;
use App\Models\Type_vehicule;
use App\Models\vehicule;
use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\CreateLivraisaonRequest;


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
        dd($request->all());
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

        $vehicules = vehicule::all();

        if (!$livraison) {
            return redirect()->route('livraison.index')->with('error', 'Livraison not found');
        }else{
            return view('livraison.edit', [
                'donnees' => compact('livraison', 'Type_vehicules', 'vehicules'),
            ]);;
        }
  
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livraison $livraison)
    {
        
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
}
