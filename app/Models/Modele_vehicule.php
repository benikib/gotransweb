<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele_vehicule extends Model
{
    /** @use HasFactory<\Database\Factories\ModeleVehiculeFactory> */
    use HasFactory;
    protected $fillable = [
        'nom_modele',
        'tarif'
    ];

}
