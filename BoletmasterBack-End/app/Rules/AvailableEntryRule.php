<?php

namespace App\Rules;

use App\Models\Entry;
use Illuminate\Contracts\Validation\Rule;

class AvailableEntryRule implements Rule
{

    protected $entries = [];

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $entradas = array_map(function ($entrada) {
            return $entrada['id'];
        }, $value);

        $entradas = Entry::select(['tipo_entrada', 'cantidad'])->whereIn('id', $entradas)->get();

        foreach ($entradas as $key => $entrada) {
            if ($entrada->cantidad < $value[$key]['cantidad']) {
                $this->entries[] = $entrada->tipo_entrada;
            }
        }

        return count($this->entries) === 0;
    }

    public function message()
    {
        return 'Las entradas ' . implode(', ', $this->entries) . ' son insuficientes.';
    }
}
