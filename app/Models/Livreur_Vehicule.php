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
    public function livreur()
    {
        return $this->belongsTo(Livreur::class, 'livreur_id');
    }
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule_id');
    }

}
