<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'nombre' => 'required|string|max:45',
            'descripcion' => 'nullable|string|max:255',
            'precio' => 'required|integer|min:0',
            //'estado_producto_id_estado_producto' => 'required|integer|exists:estado_producto,id_estado_producto',
            'tipo_producto_id_tipo_producto' => 'required|integer|exists:tipo_producto,id_tipo_producto',
            'tamano_producto_id_tamano_producto' => 'required|integer|exists:tamano_producto,id_tamano_producto',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto válido.',
            'nombre.max' => 'El nombre no puede superar los 45 caracteres.',
            
            'descripcion.string' => 'La descripción debe ser texto válido.',
            'descripcion.max' => 'La descripción no puede superar los 255 caracteres.',
            
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.integer' => 'El precio debe ser un número entero.',
/*
            'estado_producto_id_estado_producto.required' => 'El estado del producto es obligatorio.',
            'estado_producto_id_estado_producto.integer' => 'El estado seleccionado no es válido.',
            'estado_producto_id_estado_producto.exists' => 'El estado seleccionado no existe.',
 */           
            'tipo_producto_id_tipo_producto.required' => 'El tipo de producto es obligatorio.',
            'tipo_producto_id_tipo_producto.integer' => 'El tipo seleccionado no es válido.',
            'tipo_producto_id_tipo_producto.exists' => 'El tipo de producto seleccionado no existe.',
            
            'tamano_producto_id_tamano_producto.required' => 'El tamaño del producto es obligatorio.',
            'tamano_producto_id_tamano_producto.integer' => 'El tamaño seleccionado no es válido.',
            'tamano_producto_id_tamano_producto.exists' => 'El tamaño seleccionado no existe.',
        ];
    }
}
