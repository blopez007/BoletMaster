<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'fecha_hora_compra' => $this->created_at,
            'evento'            => $this->evento->titulo,
            'monto_compra'      => $this->monto_compra,
        ];
    }
}
