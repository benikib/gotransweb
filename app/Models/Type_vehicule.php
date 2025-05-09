<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_vehicule extends Model
{
    /** @use HasFactory<\Database\Factories\TypeVehiculeFactory> */
    use HasFactory;
    protected $fillable = [
        'nom_type',
        'tarif_id',
        'kilo_initiale',
        'kilo_final'
    ];
    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }
    public function tarif()
    {
        return $this->belongsTo(Tarif::class);
    }
}
