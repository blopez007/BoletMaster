<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'monto_compra',
    ];

    public function entradas(): HasMany
    {
        return $this->hasMany(VoucherEntry::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    
    public function scopeFilter($query)
    {
        $request = request();

        if ($request->has('fecha_inicio')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->fecha_inicio));
        }

        if ($request->has('fecha_fin')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->fecha_fin));
        }
    }
}
