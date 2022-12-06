<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        /**validation if admins is made in middleware ValidAdmins */
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:25|unique:categories,nombre|alpha',
        ];
    }
}
