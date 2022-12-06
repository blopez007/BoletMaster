<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'titulo'       => $this->titulo,
            'descripcion'  => $this->descripcion,
            'categoria_id' => CategoryResource::collection($this->load('categorias')->categorias),
            'lugar'        => $this->lugar,
            'fecha_hora'   => $this->fecha_hora,
            'imagen'       => $this->imagen,
        ];
    }
}
