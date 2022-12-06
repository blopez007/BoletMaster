<?php

namespace App\Rules;

use App\Models\Entry;
use Illuminate\Contracts\Validation\Rule;

class EntryIsFromEventRule implements Rule
{
    public function __construct($id_evento)
    {
        $this->id_evento = $id_evento;
    }

    public function passes($attribute, $value)
    {
        $entradas = array_map(function ($entrada) {
            return $entrada['id'];
        }, $value);
        
        $entradas = Entry::select('event_id')->whereIn('id', $entradas)->get();

        foreach ($entradas as $entrada) {
            if ($entrada->event_id != $this->id_evento) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'Las entradas no pertenecen al evento.';
    }
}
