<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoMateriaPrimaRequest extends FormRequest
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
            'tipo' => 'required|string|max:45',
        ];
    }

    public function messages(): array
    {
        return [
            'tipo.required' => 'El tipo es obligatorio.',
            'tipo.max'      => 'El tipo no puede superar los 45 caracteres.',
        ];
    }
}
