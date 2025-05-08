<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    /** @use HasFactory<\Database\Factories\VehiculeFactory> */
    use HasFactory;
    protected $fillable = [
        'immatriculation',
        'modele_vehicule_id',
        'type_vehicule_id',
        'couleur',
    ];
    public function type_vehicule()
    {
        return $this->belongsTo(Type_vehicule::class, 'type_vehicule_id');
    }
    public function modele_vehicule()
    {
        return $this->belongsTo(Modele_vehicule::class, 'modele_vehicule_id');
    }
    public function livreurs()
{
    return $this->hasMany(Livreur_Vehicule::class, 'vehicule_id');
}

}
