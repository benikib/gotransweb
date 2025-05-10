<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    /** @use HasFactory<\Database\Factories\VehiculeFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'immatriculation',
        'marque',
        'modele',
        'type',
        'couleur',
   
        'statut',
    ];

    public function Livreur()
    {
        return $this->belongsToMany(Livreur::class);
    }



}
