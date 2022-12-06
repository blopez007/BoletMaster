<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        /**validation if admins is made in middleware ValidAdmins */
        return true;
    }

    public function rules()
    {
        return [
            "nombre"   => "required|string|max:25",
            "apellido" => "required|string|max:25",
            "usuario"  => "required|string|max:25|unique:users",
            "email"    => "required|string|email|max:25|unique:users",
            "password" => "required|string|min:8|max:25",
        ];
    }
}
