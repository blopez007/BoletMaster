<?php

namespace App\Http\Requests\Voucher;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherRequest extends FormRequest
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
