<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    /** @use HasFactory<\Database\Factories\LivreurFactory> */
    use HasFactory;
    protected $fillable = [

        'user_id',

    ];



    public function livreur_vehicule()
    {
        return $this->hasMany(Livreur_Vehicule::class, 'livreur_id');
    }
    public function vehicule()
    {
        return $this->hasManyThrough(Vehicule::class, Livreur_Vehicule::class, 'livreur_id', 'id', 'id', 'vehicule_id');
    }
    public function vehicule_livreur()
    {
        return $this->hasManyThrough(Livreur_Vehicule::class, Vehicule::class, 'id', 'vehicule_id', 'id', 'livreur_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function vehicules()
{
    return $this->hasMany(Livreur_Vehicule::class, 'livreur_id');
}


}
