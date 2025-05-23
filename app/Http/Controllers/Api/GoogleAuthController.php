<?php

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GoogleAuthController extends Controller
{
        public function __invoke(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $googleToken = $request->token;

        // Vérifier le token avec Google
        $response = Http::get('https://oauth2.googleapis.com/tokeninfo', [
            'id_token' => $googleToken,
        ]);

        if (!$response->ok()) {
            return response()->json(['message' => 'Token invalide'], 401);
        }

        $googleUser = $response->json();

        // Récupérer ou créer l'utilisateur
        $user = User::updateOrCreate(
            ['email' => $googleUser['email']],
            [
                'name' => $googleUser['name'] ?? $googleUser['email'],
                'email_verified_at' => now(),
            ]
        );

        // Créer un token API Sanctum
        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }
}
