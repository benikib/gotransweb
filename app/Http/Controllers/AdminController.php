<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Type_vehicule;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAdminRequest;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\SuperAdminRequest;
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
    public function connecter(Request $request)
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
        $typeVehicules = Type_vehicule::latest()->take(3)->get();
        $vehicules = Vehicule::latest()->take(3)->get();
        $admins = Admin::latest()->take(3)->get();
        $tarifs = Tarif::latest()->take(3)->get();
        $clients = Client::latest()->take(3)->get();
        $livreur_vehicules = Livreur_Vehicule::latest()->take(3)->get();
        #dd($livreur_vehicules);

        return view('dashbord.views', compact('livreur_vehicules','livreurs','typeVehicules','livreurs','vehicules','admins','tarifs','clients'));
    }
    public function dashboard()
    {
        $livreurs=Livreur::all();
        $typeVehicules = Type_vehicule::all();
        $vehicules = Vehicule::all();
        $tarifs = Tarif::all();
        $livraisons = Livraison::all();
        $now = Carbon::now();
        $livreur_vehicules = Livreur_Vehicule::all();
        $client = Client::all()->count();
        #dd($livraisons);
        // Livraisons this day
        $today = Livraison::whereDate('created_at', $now->toDateString())->count();
        // Livraisons this week
        $thisWeek = Livraison::whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()])->count();
        //livraisons month
        $thisMonth = Livraison::whereMonth('created_at', $now->month)->count();
        return view('dashboard',
         [
        'today'=>$today,
        'thisWeek'=>$thisWeek,
        'thisMonth'=>$thisMonth,
        'livreurs'=>$livreurs,
        'typeVehicules'=>$typeVehicules,
        'vehicules'=>$vehicules,
        'livraisons'=>$livraisons,
        'tarifs'=>$tarifs,
        'livreur_vehicules'=>$livreur_vehicules,
        'client'=>$client
         ]);
    }
}
