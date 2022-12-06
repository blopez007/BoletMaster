<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_hora',
        'lugar',
        'imagen',
    ];

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function entradas(): HasMany
    {
        return $this->hasMany(Entry::class);
    }

    protected function titulo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => Str::title($value),
        );
    }

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class, 'event_id');
    }

    public function scopeFilter($query){
        $request = request();

        if($request->has('titulo')){
            $query->where('titulo', 'like', '%'.$request->titulo.'%');
        }

        if($request->has('fecha_inicio')){
            $query->where('fecha_hora', '>=', $request->fecha_inicio);
        }

        if($request->has('fecha_fin')){
            $query->where('fecha_hora', '<=', $request->fecha_fin);
        }

        if($request->has('categorias')){
            $query->whereHas('categorias', function($query) use ($request){
                $query->whereIn('category_id', $request->categorias);
            });
        }

        if(!$request->has('archivados')){
            $query->whereNull('archivado');
        }
    }

    public function scopeDestacados($query){
        $query->whereHas('categorias', function($query){
            $destacados = Category::select('id')->where('nombre','=','Destacados')->get()->first();
            $query->where('category_id', $destacados->id);
        })->limit(10);
    }

    public function scopeProximos($query){
        $query->where('fecha_hora', '>=', now())->orderBy('fecha_hora')->limit(10);
    }
}
