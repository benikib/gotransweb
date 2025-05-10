<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\SuperAdminRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('login', absolute: false));
    }
    public function connecter(SuperAdminRequest $request)
    {
    try {
        $superadmin = $request->validated();



        if(Auth::attempt($superadmin)) {
            $request->session()->regenerate();
            return redirect()->intended(route('users.index'));
        }
        return to_route('auth.login')->withErrors([
            'email' => "Email ou Mot de passe incorrect !!!"
        ])->onlyInput('email');
    } catch (\Throwable $th) {
        // Handle the exception
        return redirect()->back()->with('error', 'Erreur lors de la connexion.');
    }

        // return to_route('auth.login')->withErrors([
        //         'email' => "Email ou Mot de passe incorrect !!!"
        // ])->onlyInput('email');
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
