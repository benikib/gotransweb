<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur_Vehicule extends Model
{
    /** @use HasFactory<\Database\Factories\LivreurVehiculeFactory> */
    use HasFactory; 
    protected $fillable = [
        'livreur_id',
        'vehicule_id',
    ];

}
