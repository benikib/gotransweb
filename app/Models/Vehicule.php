<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\livraison;
class Vehicule extends Model
{
    /** @use HasFactory<\Database\Factories\VehiculeFactory> */
    use HasFactory;

    protected $fillable = [
        'immatriculation',
        'modele_vehicule_id',
        'type_vehicule_id',
        'couleur',
        'etat'
    ];
    public function type_vehicule()
    {
        return $this->belongsTo(Type_vehicule::class, 'type_vehicule_id');
    }

    public function livraisons()
{
    return $this->hasMany(Livraison::class);
}

    public function livreurs()
{
    return $this->hasMany(Livreur_Vehicule::class, 'vehicule_id');
}


}
