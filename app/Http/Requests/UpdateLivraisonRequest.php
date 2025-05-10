<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLivraisonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       
            return [
                'code' => 'required|max:255',
                'kilo_total' => 'required|min:0',
                'id_type_vehicule' => 'required|exists:type_vehicules,id',
                'id_vehicule' => 'required|exists:vehicules,id',
                'montant' => 'required|min:0',
                'status' => 'required',
                'date' => 'required|date',
                'adresse_destination' => 'required|max:255',
                'id_destination' => 'required|exists:destinations,id',
                'tel_destination' => 'required|max:255',
                'client_destinateur_id' => 'required|exists:clients,id',
                'adresse_expedition' => 'required|max:255',
                'tel_expedition' => 'required|max:255',
                'client_expediteur_id' => 'required|exists:clients,id',
                'id_expedition' => 'required|exists:expeditions,id'
                
            ];
        
    }
}
