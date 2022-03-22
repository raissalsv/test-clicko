<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactoUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'max:255',
            'apellido' => 'max:255',
            'email' => 'email:rfc,dns',
            'telefono' => 'numeric',
            'dni' => 'regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'
        ];
    }
}
