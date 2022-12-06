<?php

namespace App\Http\Requests\Voucher;

use App\Rules\AvailableEntryRule;
use App\Rules\EntryIsFromEventRule;
use App\Rules\ExistEntryRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVoucherRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id_evento' => 'required|integer|exists:events,id',
            'entradas'  => [
                'bail',
                'required',
                'array',
                new EntryIsFromEventRule($this->id_evento),
                new ExistEntryRule,
                new AvailableEntryRule,
            ],
            'entradas.*'          => 'min:1|distinct',
            'entradas.*.id'       => 'required|integer',
            'entradas.*.cantidad' => 'required|integer|min:1',
        ];
    }
}
