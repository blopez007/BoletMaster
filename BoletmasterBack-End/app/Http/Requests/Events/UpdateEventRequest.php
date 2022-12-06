<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'titulo' => [
                'string',
                'max:150',
                Rule::unique('events')->ignore($this->event->id),
            ],
            'descripcion'             => 'string|max:300',
            'lugar'                   => 'string|max:100',
            'fecha_hora'              => 'required|date_format:Y-m-d H:i|after_or_equal:' . date(DATE_ATOM),
            'categorias'              => 'nullable|array',
            'categorias.*'            => 'required|integer|exists:categories,id',
            'entradas'                => 'array',
            'entradas.*'              => 'min:1',
            'entradas.*.id'           => 'integer|exists:entries,id',
            'entradas.*.tipo_entrada' => 'string|distinct',
            'entradas.*.precio'       => 'numeric|min:1',
            'entradas.*.cantidad'     => 'numeric|min:1',
            'imagen'                  => 'mimes:jpg,png,jpeg',
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
