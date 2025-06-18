<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Livreur;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $admins = Admin::all();
        $clients = Client::all();
        $livreurs = Livreur::all();
        $count = 1;
        #dd(count(Admin::all()));
        return view('users.index', compact('users', 'admins', 'clients', 'livreurs', 'count'));

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
        return redirect()->route('admin.index')->with('success', 'Admin créé avec succès');
    }
    public function login()
    {
        return view('forms.login');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {



       /* try {

             $validated = $request->validated([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique',
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

*/       // Validate the request
        $validated = $request->validated();

        $user = User::create($validated);
        #($validated['role']);
        // Assigner le rôle


        // Insérer dans la bonne table selon le rôle
        switch ($validated['role']) {
            case 'admin':
                Admin::create(['user_id' => $user->id]);
                 // Redirect to the user index page
                return redirect()->route('users.index',['m' => 'admin'])->with('success', 'Admin créé avec succès.');
                break;
            case 'client':
               Client::create(['user_id' => $user->id]);
                // Redirect to the user index page
                return redirect()->route('users.index',['m' => 'client'])->with('success', 'Client créé avec succès.');
                break;
            case 'livreur':
                Livreur::create(['user_id' => $user->id]);
                 // Redirect to the user index page
                return redirect()->route('users.index',['m' => 'livreur'])->with('success', 'Livreur créé avec succès.');
                break;
        }

        // Redirect to the user index page
        #return redirect()->route('users.index');
        /*} catch (\Throwable $th) {
            #dd($th);
        }*/

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
    public function edit(User $user)

    {
        #dd($user);
      return view('users.edit',[
        'use' => $user
      ]);
    }
    /**
     * Update the specified resource in storage.
     */
    // public function update(User $user, UpdateUserRequest $request){

    //     $user->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'number_phone' => $request->number_phone,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    // }

    public function update(User $user, UpdateUserRequest $request)
{
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'number_phone' => $request->number_phone,
        'password' => Hash::make($request->password),
    ]);
    
     $mode = $request->input('m'); 
     // Insérer dans la bonne table selon le rôle
        switch ($mode) {
            case 'admin':
                
                 // Redirect to the user index page
                return redirect()->route('users.index',['m' => 'admin'])->with('success', 'Admin créé avec succès.');
                break;
            case 'client':
                // Redirect to the user index page
                return redirect()->route('users.index',['m' => 'client'])->with('success', 'Client créé avec succès.');
                break;
            case 'livreur':
                 // Redirect to the user index page
                return redirect()->route('users.index',['m' => 'livreur'])->with('success', 'Livreur créé avec succès.');
                break;
        }
        #dd($mode);

    // Vérifier le rôle de l'utilisateur et mettre à jour la table correspondante
     return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
{
    ##dd($user->id);
    $client = Client::where('user_id', $user->id)->first();
    $admin = Admin::where('user_id', $user->id)->first();
    $livreur = Livreur::where('user_id', $user->id)->first();
    if ($client) {
        Client::destroy($client->id);
    } elseif ($admin) {
        Admin::destroy($admin->id);
    } elseif ($livreur) {
        Livreur::destroy($livreur->id);
    } else {
        dd($user->id);
    }
    User::destroy($user->id); // on passe l'ID, pas l'objet complet
    return redirect()->back()->with('success', 'Utilisateur supprimé avec succès');
}

}

