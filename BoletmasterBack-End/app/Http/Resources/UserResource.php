<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'nombre'   => $this->nombre,
            'apellido' => $this->apellido,
            'archivado' =>$this->archivado,
            'usuario'  => $this->usuario,
            'email'    => $this->email,
            'rol'      => $this->rol,
        ];
    }
}
