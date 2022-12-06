<?php

namespace App\Http\Requests\Entries;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntryRequest extends FormRequest
{
    public function authorize()
    {
        /**validation if admins is made in middleware ValidAdmins */
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
