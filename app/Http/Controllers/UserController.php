<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Livreur;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $admins = Admin::all();
        $clients = Client::all();
        $livreurs = Livreur::all();
        return view('users.index', compact('users', 'admins', 'clients', 'livreurs'));

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
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
        return view('forms.login');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try {
            
             $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'number_phone' => 'nullable|string|max:15',
            'role' => 'required|string|in:admin,client,livreur', // vérifie que le rôle est valide
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'number_phone' => $validated['number_phone'],
        ]);

        // Assigner le rôle
        

        // Insérer dans la bonne table selon le rôle
        switch ($validated['role']) {
            case 'admin':
                Admin::create(['user_id' => $user->id]);
                break;
            case 'client':
               Client::create(['user_id' => $user->id]);
                break;
            case 'livreur':
                Livreur::create(['user_id' => $user->id]);
                break;
        }

        // Redirect to the user index page
        return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Throwable $th) {
            dd($th);
        }
       
        // Validate the request
        // Create a new user

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

        //


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}

