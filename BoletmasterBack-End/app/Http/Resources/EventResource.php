<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'titulo'      => $this->titulo,
            'descripcion' => $this->descripcion,
            'categorias'  => CategoryResource::collection($this->categorias),
            'fecha_hora'   => $this->fecha_hora,
            'imagen'   => $this->imagen,
            'lugar'    => $this->lugar,
            'entradas' => EntryResource::collection($this->entradas),
        ];
    }
}
