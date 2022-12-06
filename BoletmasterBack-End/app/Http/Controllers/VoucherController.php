<?php

namespace App\Http\Controllers;

use App\Http\Requests\Voucher\{StoreVoucherRequest, UpdateVoucherRequest};
use App\Http\Resources\{VoucherResource, VoucherShowResource};
use App\Models\{Entry, User, Voucher, VoucherEntry};
class VoucherController extends Controller
{
    public function index()
    {
        $user     = auth()->user();
        $vouchers = $user->vouchers()->with('evento')->get();

        return VoucherResource::collection($vouchers);
    }

    public function store(StoreVoucherRequest $request)
    {
        $voucher               = new Voucher();
        $voucher->user_id      = auth()->user()->id;
        $voucher->event_id     = $request->id_evento;
        $voucher->monto_compra = 0;
        $voucher->save();

        $entradas = array_map(function ($entrada) {
            return $entrada['id'];
        }, $request->entradas);

        $entradas = Entry::select()->whereIn('id', $entradas)->get();

        $total_compra = 0;
        $voucherEntry = [];

        foreach ($entradas as $key => $entrada) {
            $cantidad = $request->entradas[$key]['cantidad'];
            $total    = $cantidad * $entrada->precio;
            $entrada->cantidad -= $cantidad;
            $entrada->save();

            $total_compra += $entrada->precio * $request->entradas[$key]['cantidad'];
            $voucherEntry[] = [
                'voucher_id'        => $voucher->id,
                'entry_id'          => $entrada->id,
                'cantidad_comprada' => $cantidad,
                'precio_total'      => $total,
            ];
        }

        $voucher->monto_compra = $total_compra;
        $voucher->save();

        VoucherEntry::insert($voucherEntry);
    }

    public function show(Voucher $voucher)
    {
        $voucher->load('entradas','entradas.entrada', 'evento');
        
        return VoucherShowResource::make($voucher);
    }

    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        //
    }

    public function destroy(Voucher $voucher)
    {
        //
    }
}
