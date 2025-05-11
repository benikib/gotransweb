<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Type_vehicule;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SuperAdminRequest;
use App\Models\Livraison;
use App\Models\Livreur;
use App\Models\Livreur_Vehicule;
use App\Models\Tarif;
use App\Models\Vehicule;
use Carbon\Carbon;

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
        }else{
            return back()->withErrors([
                'email' => "Email ou Mot de passe incorrect !!!"
            ])->onlyInput('email');
        }

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
    public function views(Admin $admin)
    {
        $livreurs=Livreur::latest()->take(3)->get();
        $typeVehicules = Type_vehicule::latest()->take(3)->get();;
        $vehicules = Vehicule::latest()->take(3)->get();;
        $admins = Admin::latest()->take(3)->get();;
        $tarifs = Tarif::latest()->take(3)->get();;

        return view('dashbord.views', compact('livreurs','typeVehicules','livreurs','vehicules','admins','tarifs'));
    }
    public function dashboard()
    {
         $livreurs=Livreur::all();
        $typeVehicules = Type_vehicule::all();
        $vehicules = Vehicule::all();
        $admins = Admin::all();
        $tarifs = Tarif::all();
        $users = User::all();
        $livraisons = Livraison::all();
         $now = Carbon::now();
         $livreur_vehicules = Livreur_Vehicule::all();

    // Livraisons
    $thisWeek = Livraison::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
    $lastWeek = Livraison::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count();
    $livraisonsPourcentage = $lastWeek > 0 ? round((($thisWeek - $lastWeek) / $lastWeek) * 100) : 0;

    // Utilisateurs
    $today = User::whereDate('created_at', today())->count();
    $yesterday = User::whereDate('created_at', today()->subDay())->count();
    $usersPourcentage = $yesterday > 0 ? round((($today - $yesterday) / $yesterday) * 100) : 0;
        return view('dashboard', 
         [
        'livraisonsThisWeek' => $thisWeek,
        'livraisonsPourcentage' => $livraisonsPourcentage,
        'usersToday' => $today,
        'usersPourcentage' => $usersPourcentage,
        'livreurs'=>$livreurs,
        'typeVehicules'=>$typeVehicules,
        'vehicules'=>$vehicules,
        'livraisons'=>$livraisons,
        'tarifs'=>$tarifs,  
        'livreur_vehicules'=>$livreur_vehicules,
         ]);
    }
}
