<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Item;

class EditItemPanaderoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Item|null $item */
        $item = $this->route('itemPanadero');

        $max = $item->cantidad;

        return [
            'cantidad' => [
                'required',
                'integer',
                'min:0',
                'max:' . $max,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'cantidad.required' => 'La cantidad es obligatori',
            'cantidad.integer'  => 'La cantidad debe ser un número entero',
            'cantidad.min'      => 'La cantidad no puede ser menor que 0',
            'cantidad.max'      => 'La cantidad no puede ser mayor que la cantidad disponible del ítem',
        ];
    }
}
