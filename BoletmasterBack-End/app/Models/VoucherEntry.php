<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherEntry extends Model
{
    use HasFactory;

    protected $table = 'entries_voucher';

    protected $fillable = [
        'tipo_entrada',
        'cantidad',
        'precio',
    ];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function entrada()
    {
        return $this->belongsTo(Entry::class, 'entry_id');
    }

}
