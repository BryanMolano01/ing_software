<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Permitir que cualquier usuario autenticado (o controlador) pueda usar este request.
        // Si necesitas controles más finos, reemplaza esto por la lógica necesaria.
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
            'nombre' => 'required|string|max:45',
            'telefono' => 'required|digits_between:7,15',
        ];
    }



    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del proveedor es obligatorio.',
            'nombre.string'   => 'El nombre del proveedor debe ser texto válido.',
            'nombre.max'      => 'El nombre no puede superar los 45 caracteres.',

            'telefono.required'      => 'El teléfono es obligatorio.',
            'telefono.digits_between' => 'El teléfono debe contener solo números y tener entre 7 y 15 dígitos.',
        ];
    }
}
