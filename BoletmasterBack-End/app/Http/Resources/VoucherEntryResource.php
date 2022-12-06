<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherEntryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'tipo_entrada' => $this->entrada->tipo_entrada,
            'cantidad'     => $this->cantidad_comprada,
            'precio_unitario'       => $this->entrada->precio,
            'precio_total' => $this->precio_total,
        ];
    }
}
