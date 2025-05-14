<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivraisonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //parent::toArray($request)
        return [
            'id' => $this->id,
            'adresse_expedition' => $this->adresse_expedition,
            'tel_expedition' => $this->tel_expedition,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'vehicule_id' => $this->vehicule_id,
            'client_id' => $this->client_id,
            'livreur_id' => $this->livreur_id,
        ];
    } 
    
}
