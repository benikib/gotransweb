<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

       $request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    'password' => [
        'required',
        'confirmed',
        Rules\Password::min(8)
            ->mixedCase()        // Majuscules et minuscules
            ->letters()          // Au moins une lettre
            ->numbers()          // Au moins un chiffre
            ->symbols()          // Au moins un caractère spécial
            ->uncompromised(),   // Vérifie que le mot de passe n’est pas dans les fuites de données connues
    ],
], [
    'name.required' => 'Veuillez renseigner votre nom.',
    'email.required' => 'Veuillez entrer une adresse e-mail.',
    'email.email' => 'Veuillez entrer une adresse e-mail valide.',
    'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
    'password.required' => 'Veuillez définir un mot de passe.',
    'password.confirmed' => 'Les mots de passe ne correspondent pas.',
    'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
    'password.mixed' => 'Le mot de passe doit contenir des lettres majuscules et minuscules.',
    'password.letters' => 'Le mot de passe doit contenir au moins une lettre.',
    'password.numbers' => 'Le mot de passe doit contenir au moins un chiffre.',
    'password.symbols' => 'Le mot de passe doit contenir au moins un caractère spécial.',
    'password.uncompromised' => 'Ce mot de passe a été compromis dans une fuite de données. Veuillez en choisir un autre.',

]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Admin::create(['user_id' => $user->id]);

        Auth::login($user);

        return  redirect(url('/dashboard'));
    }
}
