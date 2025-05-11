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
            'status' => 'required',
            'date' => 'required|date',

            'adresse_destination' => 'required|max:255',
            'tel_destination' => 'required|max:255',
            'client_destinateur_id' => 'required|exists:clients,id',
            'adresse_expedition' => 'required|max:255',
            'tel_expedition' => 'required|max:255',

            'client_expediteur_id' => 'required|exists:clients,id',


        ];
    }
}
