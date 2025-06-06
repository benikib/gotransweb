<?php

namespace App\Http\Controllers;

use App\Models\Localisation;
use Illuminate\Http\Request;

class LocalisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Request $livraison_id)
    {
        // $localisation = Localisation::where('livraison_id', $request->livraison_id)->first();
        try {
            $localisation = Localisation::where('livraison_id', $livraison_id)->first();
        if (!$localisation) {
            return  response()->json($data, 200, $headers);()->json(['message' => 'Localisation not found'], 404);
        }


            return response()->json(["localisation"=>$localisation], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Localisation not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Localisation $localisation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request)
    {
     try {
            $request->validate([
            'longitude' => 'sometimes|required|numeric',
            'latitude' => 'sometimes|required|numeric',
            'livraison_id' => 'sometimes|required|exists:livraisons,id',
        ]);

        $localisation = Localisation::where('livraison_id',  $request->livraison_id)->first();
        if ($localisation) {
            $localisation->longitude = $request->longitude;
            $localisation->latitude = $request->latitude;
             $localisation->save();

        return response()->json($localisation,200);
        }
        if(!$localisation) {
            $localisation = new Localisation();
            $localisation->livraison_id = $request->livraison_id;
            $localisation->longitude = $request->longitude;
            $localisation->latitude = $request->latitude;
            $localisation->save();

        return response()->json(["localisation"=>$localisation],200);
        }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Localisation $localisation)
    {
        //
    }
}
