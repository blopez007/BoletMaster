<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'fecha_compra' => $this->created_at,
            'evento'       => [
                'titulo'     => $this->evento->titulo,
                'fecha_hora' => $this->evento->fecha_hora,
                'lugar'      => $this->evento->lugar,
                'imagen'     => $this->evento->imagen,
            ],
            'entradas'     => VoucherEntryResource::collection($this->entradas),
            'monto_compra' => $this->monto_compra,
        ];
    }
}
