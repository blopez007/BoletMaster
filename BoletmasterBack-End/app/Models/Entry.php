<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_entrada',
        'cantidad',
        'precio',
    ];

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public static function findOrNew($id)
    {
        $obj = static::find($id);
        return $obj ?: new static;
    }
}
