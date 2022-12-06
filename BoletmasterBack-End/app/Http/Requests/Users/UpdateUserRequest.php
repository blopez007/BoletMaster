<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        /**validation if admins is made in middleware ValidAdmins */
        return true;
    }

    public function rules()
    {
        return [
            "nombre"    => "string|max:25",
            "apellido"  => "string|max:25",
            "usuario"   => "string|max:25|unique:users",
            "email"     => "string|email|max:25|unique:users",
            "password"  => "string|min:8|max:25",
            "archivado" => "string|max:25",
        ];
    }
}
