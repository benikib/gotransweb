<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    /** @use HasFactory<\Database\Factories\TarifFactory> */
    use HasFactory;
    protected $fillable = [
        'type',
        'nom',
        'valeur',
        'prix'

    ];
    public function typeVehicule()
    {
        return $this->hasMany(Type_vehicule::class);
    }

}
