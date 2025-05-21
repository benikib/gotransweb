<?php





namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;


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

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::defaults() ],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['message' => 'Mot de passe mis à jour']);
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
}
