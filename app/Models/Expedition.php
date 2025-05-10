<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedition extends Model
{
    /** @use HasFactory<\Database\Factories\ExpeditionFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'adresse',
        'longitude',
        'latitude',
        'tel_expedition'
    ];
}
