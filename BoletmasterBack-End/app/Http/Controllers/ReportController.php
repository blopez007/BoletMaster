<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Voucher;
use Barryvdh\DomPDF\Facade\Pdf as Report;

class ReportController extends Controller
{
    public function ventas()
    {
        $now  = now()->setTimezone('America/El_Salvador');
        $user = auth()->user();

        Logs::create([
            "tipo_evento"   => 'reporte',
            "user_id" => $user->id,
        ]);

        $ventas = Voucher::filter()->get()->groupBy(function($item) {
            return $item->created_at->format('F-Y');
        });

        $ventas = $ventas->map(function($item) {
            return $item->sum('monto_compra');
        });

        $eventos = Voucher::with(['evento', 'entradas', 'entradas.entrada'])->filter()->get();

        $eventos = $eventos->map(function($item) {
            return [
                'nombre' => $item->evento->titulo,
                'entradas' => $item->entradas->map(function($entrada) {
                    return [
                        'tipo_entrada' => $entrada->entrada->tipo_entrada,
                        'cantidad_comprada' => $entrada->cantidad_comprada,
                        'precio' => $entrada->entrada->precio,
                    ];
                }),
            ];
        });

        $eventos = $eventos->groupBy('nombre');

        $eventos = $eventos->map(function($item) {
            return $item->map(function($item) {
                return $item['entradas'];
            })->flatten(1);
        });

        $eventos = $eventos->map(function($item) {
            return $item->groupBy('tipo_entrada');
        });

        $eventos = $eventos->map(function($item) {
            return $item->map(function($item) {
                return [
                    'cantidad' => $item->sum('cantidad_comprada'),
                    'precio' => $item->first()['precio'],
                ];
            });
        });

        $eventos = $eventos->map(function($item) {
            //calcular el total de cada evento
            return [
                'total' => $item->sum(function($item) {
                    return $item['cantidad'] * $item['precio'];
                }),
                'entradas' => $item,
            ];
        });

        $data = [
            'fecha'   => $now->format('d/m/Y'),
            'hora'    => $now->format('h:i:s A'),
            'usuario' => $user->usuario,
            'nombre'  => $user->nombre . ' ' . $user->apellido,
            'correo'  => $user->email,
            'cargo'   => 'Administrador',
            'anio'    => $now->format('Y'),
            'ventas'  => $ventas,
            'eventos' => $eventos,
        ];

        $pdf = Report::loadView('report-ventas', $data);

        return $pdf->download('reporte-ventas.pdf');
    }
}
