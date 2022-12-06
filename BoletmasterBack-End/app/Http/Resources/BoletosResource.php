<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoletosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'evento' => [
                'titulo' => $this->evento->titulo,
                'fecha'  => date('d-m-Y', strtotime($this->evento->fecha_hora)),
            ],
            'id' => $this->id
        ];
    }
}
