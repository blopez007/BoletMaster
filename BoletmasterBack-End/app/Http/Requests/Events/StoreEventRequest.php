<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'titulo'                  => 'required|string|max:150|unique:events,titulo',
            'descripcion'             => 'required|string|max:300',
            'lugar'                   => 'required|string|max:100',
            'fecha_hora'              => 'required|date_format:Y-m-d H:i|after_or_equal:' . date(DATE_ATOM),
            'categorias'              => 'nullable|array|exists:categories,id',
            'categorias.*'            => 'required|integer',
            'imagen'                  => 'required|mimes:jpg,png,jpeg',
            'entradas'                => 'required|array',
            'entradas.*'              => 'min:1',
            'entradas.*.tipo_entrada' => 'required|string|distinct',
            'entradas.*.precio'       => 'required|numeric|min:1',
            'entradas.*.cantidad'     => 'required|numeric|min:1',
        ];
    }

    public function prepareForValidation()
    {
        $entradas = json_decode($this['entradas']);
        

        $entradas = array_map(function($entrada) {
            return (array)$entrada;
        }, $entradas);

        $this->merge([ 
            'categorias' => json_decode($this['categorias']),
            'entradas'   => $entradas,
        ]);
    }
}
