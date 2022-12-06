<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DashboardRequest extends FormRequest
{
    public function rules()
    {
        return [
            'fecha_inicio' => 'nullable|date_format:Y-m-d',
            'fecha_fin'    => 'nullable|date_format:Y-m-d',
        ];
    }
}
