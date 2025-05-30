<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehiculeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(
            parent::toArray($request),  // toutes les données par défaut du modèle Livraison
            [
               
                'type_vehicule' => new TypeVehiculeResource($this->whenLoaded('type_vehicule'))
            ]
        );
    }
}
