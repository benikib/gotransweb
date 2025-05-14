<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Type_vehicule;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'name'     => $fields['name'],
            'email'    => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);
        $clientt= Client::create(['user_id' => $user->id]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'client' => $clientt,
            'user'  => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les informations d identification sont incorrectes.'],
            ]);
        }


        $token = $user->createToken('api-token')->plainTextToken;
        $user = User::find($user->id);
        $roleInfo = $user->getRoleInfo();

if ($roleInfo) {
 return response()->json([
            'user'  => $user,
            'token' => $token
        ], 201);
} else {
      return response()->json([
            'error'  =>'Aucun user trouvé pour cet utilisateur.',

        ], 201);
}



    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete(); // Supprime tous les tokens

        return response()->json([
            'message' => 'Déconnexion réussie'
        ],201);
    }
    public function getTypeVehicule(){
       $typeVehicule = Type_vehicule::all();
        return response()->json([
            'typeVehicule' => $typeVehicule
        ], 200);
    }
}
