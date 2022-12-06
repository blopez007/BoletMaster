<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class IndexEventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'titulo'       => 'string',
            'fecha_inicio' => 'date|before_or_equal:fecha_fin|date_format:Y-m-d',
            'fecha_fin'    => 'date|after_or_equal:fecha_inicio|date_format:Y-m-d',
            'categorias'   => 'array|exists:categories,id',
            'categorias.*' => 'distinct',
            'archivados'   => 'string',
        ];
    }
}
