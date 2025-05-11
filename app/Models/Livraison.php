<?php

namespace App\Models;
use App\Models\Vehicule;
use App\Models\Client;
use App\Models\Destination;
use App\Models\Expedition;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    /** @use HasFactory<\Database\Factories\LivraisonFactory> */
    use HasFactory;


    protected $fillable = [
        'id',
        'date',
        'status',
        'code',
        'montant',
        'expedition_id',
        'destination_id',
        'client_expediteur_id',
        'client_destinateur_id',
        'vehicule_id',
        'moyen_transport',
        'Kilo_total',
        
    ];




    public function Vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function Destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function Expedition()
    {
        return $this->belongsTo(Expedition::class);
    }

    public function expediteur()
    {
        return $this->belongsTo(Client::class, 'client_expediteur_id');
    }

    public function destinateur()
    {
        return $this->belongsTo(Client::class, 'client_destinateur_id');
    }
}
