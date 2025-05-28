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
        return array_merge(
            parent::toArray($request),  // toutes les données par défaut du modèle Livraison
            [
                'destination' => new DestinationResource($this->whenLoaded('Destination')),
                'expedition' => new ExpeditionResource($this->whenLoaded('Expedition')),
              
                'vehicule' => new VehiculeResource($this->whenLoaded('Vehicule')),
                'livreur' => new LivreurResource($this->whenLoaded('livreur'))
            ]
        );
    } 
    
}
