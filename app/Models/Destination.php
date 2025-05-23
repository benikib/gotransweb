<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    /** @use HasFactory<\Database\Factories\DestinationFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'adresse',
        'longitude',
        'latitude',
        'nom_destination',
        'tel_destination'
    ];
}
