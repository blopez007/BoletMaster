<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "oldpassword" => "required",
            "newpassword1" => "required|string|min:8|max:25",
            "newpassword2" => "required|string|min:8|max:25",
        ];
    }
}
