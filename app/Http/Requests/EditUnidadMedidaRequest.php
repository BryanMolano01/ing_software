<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUnidadMedidaRequest extends FormRequest
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
            'unidad' => 'required|string|max:20',
        ];
    }
    public function messages(): array
    {
        return [
            'unidad.required' => 'La unidad es obligatoria.',
            'unidad.max'      => 'La unidad no puede superar los 20 caracteres.',
        ];
    }
}
