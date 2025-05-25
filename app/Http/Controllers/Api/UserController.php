<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use App\Http\Resources\ClientResource;
use App\Http\Resources\UserResource;
use App\Models\Client;

class UserController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'data' => $request->user()->loadMissing('profilePhoto')
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'number_phone' => 'nullable|string|max:20',
        ]);

        $request->user()->update($validated);

        return response()->json([
            'message' => 'Profil mis à jour',
            'data' => $request->user()->fresh()
        ]);
    }

    public function changePassword(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        // Vérifie le mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Le mot de passe actuel est incorrect'
            ], 401);
        }

        // Met à jour le mot de passe
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'message' => 'Mot de passe mis à jour avec succès'
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $path = $request->file('photo')->store('profile-photos');

        if ($oldPhoto = $request->user()->profile_photo_path) {
            Storage::delete($oldPhoto);
        }

        $request->user()->update([
            'profile_photo_path' => $path
        ]);

        return response()->json([
            'message' => 'Photo de profil mise à jour',
            'photo_url' => Storage::url($path)
        ]);
    }

    public function getClients()
    {
        $clients = Client::with('user')->get();// relation directe

        return response()->json([
            'message' => 'Clients de l’utilisateur connecté'
        ]);
        
    }
}
