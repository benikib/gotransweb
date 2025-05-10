<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLivraisaonRequest extends FormRequest
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
            'Kilo_total' => 'required|min:0',
            'moyen_transport' => 'required|exists:type_vehicules,nom_type',
            'montant' => 'required|min:0',
            
            'id_type_vehicule' => 'required|exists:type_vehicules,id',
            'id_vehicule' => 'required|exists:vehicules,id',
            'adresse_destination' => 'required|max:255',
            'tel_destination' => 'required|max:255',
            'id_client_destinateur' => 'required|exists:clients,id',
            'adresse_expedition' => 'required|max:255',
            'tel_expedition' => 'required|max:255',
            'id_client_expediteur' => 'required|exists:clients,id',
            
        ];
    }
}
