<?php

namespace App\Http\Requests;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Nombre' => ['required', 'string', 'max:100'],
            'Apellido' => ['required', 'string', 'max:100'],
            'Email' => [
                'required',
                'string',
                'email',
                'max:150',
                Rule::unique('Usuarios', 'Email')->ignore($this->user()->ID_USUario, 'ID_USUario'),
            ],
            'Telefono' => ['nullable', 'string', 'max:20'],
        ];
    }
}
