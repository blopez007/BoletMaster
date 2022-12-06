<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\DashboardRequest;
use App\Models\Voucher;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardController extends Controller
{
    public function ventasDiarias(DashboardRequest $request)
    {
        $ventas = Voucher::filter()->get()->groupBy(function($item) {
            return $item->created_at->format('d-M-y');
        });

        $ventas = $ventas->map(function($item) {
            return $item->sum('monto_compra');
        });

        $dias   = $ventas->keys();
        $montos = $ventas->values();

        return JsonResource::make([
            'labels'   => $dias,
            'datasets' => [
                [
                    'label' => 'Ventas Diarias',
                    'data'  => $montos,
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    'borderWidth' => 3,
                ],
            ],
        ]);
    }

    public function ventasPorEventos(DashboardRequest $request)
    {
        $ventas = Voucher::with('evento')->filter()->get()->groupBy(function($item) {
            return $item->evento->titulo;
        });
        $ventas = $ventas->map(function($item) {
            return $item->sum('monto_compra');
        });
        $eventos = $ventas->keys();
        $montos  = $ventas->values();

        return JsonResource::make([
            'labels'   => $eventos,
            'datasets' => [
                [
                    'label'           => 'Ventas Por Eventos',
                    'data'            => $montos,
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    'borderWidth' => 3,
                ],
            ],
        ]);
    }
}