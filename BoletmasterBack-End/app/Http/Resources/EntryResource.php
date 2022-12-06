<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'tipo_entrada' => $this->tipo_entrada,
            'precio'       => $this->precio,
            'cantidad' => $this->cantidad
            
        ];
    }
}
