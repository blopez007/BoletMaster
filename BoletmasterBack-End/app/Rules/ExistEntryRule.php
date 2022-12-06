<?php

namespace App\Rules;

use App\Models\Entry;
use Illuminate\Contracts\Validation\Rule;

class ExistEntryRule implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $entradas = array_map(function ($entrada) {
            return $entrada['id'];
        }, $value);
        
        $entradasCount = Entry::whereIn('id', $entradas)->count();

        return $entradasCount == count($entradas);
    }

    public function message()
    {
        return 'Las entradas no existen.';
    }
}
