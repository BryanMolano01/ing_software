<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditMateriaPrimaRequest extends FormRequest
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
            'cantidad' => 'required|integer|min:1|max:999',
            'unidad_materia_prima_id_unidad_materia_prima' => 'required|integer|exists:unidad_materia_prima,id_unidad_materia_prima',
            'proveedor_id_proveedor' => 'required|integer|exists:proveedor,id_proveedor',
            'tipo_item_id_tipo_item' => 'required|integer|exists:tipo_item,id_tipo_item',
            'ubicacion_id_ubicacion' => 'required|integer|exists:ubicacion,id_ubicacion',
        ];
    }


    public function messages(): array
    {
        return [
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',
            'cantidad.max' => 'La cantidad no puede ser mayor a 999.',
            'unidad_materia_prima_id_unidad_materia_prima.required' => 'La medida es obligatoria.',
            'unidad_materia_prima_id_unidad_materia_prima.integer' => 'La medida seleccionada no es válida.',
            'unidad_materia_prima_id_unidad_materia_prima.exists' => 'La unidad seleccionada no existe.',
            'proveedor_id_proveedor.required' => 'El proveedor es obligatorio.',
            'proveedor_id_proveedor.integer' => 'El proveedor seleccionado no es válido.',
            'proveedor_id_proveedor.exists' => 'El proveedor seleccionado no existe.',
            'tipo_item_id_tipo_item.required' => 'El tipo es obligatorio.',
            'tipo_item_id_tipo_item.integer' => 'El tipo seleccionado no es válido.',
            'tipo_item_id_tipo_item.exists' => 'El tipo seleccionado no existe.',
            'ubicacion_id_ubicacion.required' => 'La ubicación es obligatoria.',
            'ubicacion_id_ubicacion.integer' => 'La ubicación seleccionada no es válida.',
            'ubicacion_id_ubicacion.exists' => 'La ubicación seleccionada no existe.',
        ];
    }
}
