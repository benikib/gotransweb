<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localisation extends Model
{
    /** @use HasFactory<\Database\Factories\LocalisationFactory> */
    use HasFactory;
    protected $fillable = [
        'longitude',
        'latitude',
        'livraison_id',
    ];
    protected $casts = [
        'longitude' => 'float',
        'latitude' => 'float',
    ];
    public function livraison()
    {
        return $this->belongsTo(Livraison::class);
    }
    public function getCoordinatesAttribute()
    {
        return [
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }
    public function setCoordinatesAttribute(array $coordinates)
    {
        $this->longitude = $coordinates['longitude'] ?? null;
        $this->latitude = $coordinates['latitude'] ?? null;
    }
}
