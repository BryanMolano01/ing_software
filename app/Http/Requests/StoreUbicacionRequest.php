<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUbicacionRequest extends FormRequest
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
            'ubicacion' => 'required|string|max:45',
        ];
    }
    public function messages(): array
    {
        return [
            'ubicacion.required' => 'La ubicacion es obligatorio.',
            'ubicacion.max'      => 'La ubicacion no puede superar los 45 caracteres.',
        ];
    }
}
