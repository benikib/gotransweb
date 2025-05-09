<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SuperAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::all();
        return view('users.index', compact('admins'));
        
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateAdminRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        // Create a new admin
        $admin = User::create($validated);

        // Redirect to the admin index page
        return redirect()->route('admin.index')->with('success', 'Admin created successfully.');
    }
    public function login()
    {
        return view('auth.login');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function connecter(SuperAdminRequest $request)
    {
        $superadmin = $request->validated();
        dd($superadmin);
        if(Auth::attempt($superadmin)) {
            $request->session()->regenerate();
            return redirect()->intended(route('users.index')); 
        }
        return to_route('auth.login')->withErrors([
                'email' => "Email ou Mot de passe incorrect !!!"
        ])->onlyInput('email');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
