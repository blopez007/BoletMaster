<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\{IndexUserRequest, PasswordRequest, StoreUserRequest, UpdateUserRequest};
use App\Http\Resources\{BoletosResource, UserResource};
use App\Models\{User, Voucher};
use Barryvdh\DomPDF\Facade\Pdf as Ticket;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::filter()->paginate();

        return UserResource::collection($users);
    }
    
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            "nombre"   => $request->nombre,
            "apellido" => $request->apellido,
            "usuario"  => $request->usuario,
            "email"    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Users created successfully.', 'token' => $user->createToken('authToken')->plainTextToken], 201);
    }

    public function show(User $user)
    {
        if (auth()->user()->rol() || auth()->user()->id == $user->id) {
            return new UserResource($user);
        }
  
        return response()->json(['message' => 'Unauthorized.'], 401);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if (auth()->user()->rol() || auth()->user()->id == $user->id) {
            $user->update($request->all());

            return response()->json(['message' => 'User updated successfully.'], 200);
        }

        return response()->json(['message' => 'Unauthorized.'], 401);
    }
    public function resetPassword(PasswordRequest $request, User $user){
        if (auth()->user()->rol() || auth()->user()->id == $user->id) {
            $password = $user->password;
            $newpassword1 = $request->newpassword1;
            $newpassword2 = $request->newpassword2;
            if (!Hash::check($request->oldpassword, $password)){

                return response()->json(['message' => 'contrasenia actual invalida'], 200);
            };
            if( $newpassword1 == $newpassword2){
                $user->password = Hash::make($request->newpassword1);
                $user->save();
                return response()->json(['message' => 'Password update successfully.'], 200);
            }
            else{
                return response()->json(['message' => 'Las contrasenias nuevas no coinciden'], 200);
            }
            
        }
        
    }

    public function boletos()
    {
        $user    = auth()->user();
        $boletos = $user->vouchers()->with(['evento', 'entradas', 'entradas.entrada'])->orderBy('created_at', "DESC")->get();

        return BoletosResource::collection($boletos);
    }

    public function generarTicket(User $user, Voucher $voucher)
    {
        $voucher->load(['evento', 'entradas', 'user', 'entradas.entrada' ]);
        $data = [
            'usuario'      => $voucher->user,
            'evento'       => $voucher->evento->titulo,
            'fecha_compra' => date('d-m-Y', strtotime($voucher->created_at)),
            'hora_compra'  => date('H:i A', strtotime($voucher->created_at)),
            'fecha_evento' => date('d-m-Y', strtotime($voucher->evento->fecha_hora)),
            'hora_evento'  => date('H:i A', strtotime($voucher->evento->fecha_hora)),
            'id'           => $voucher->id,
            'entradas'     => $voucher->entradas,
            'monto_compra'   => $voucher->monto_compra
        ];
        $pdf = Ticket::loadView('ticket', $data);

        return $pdf->download('ticket.pdf');
    }

    public function destroy(User $user)
    {
        $user->archivado = now();
        $user->save();

        return response()->json(['message' => 'Users archivated successfully.'], 200);
    }

    public function profile()
    {
        return response()->json(['user' => auth()->user()], 200);
    }

    public function convertir(User $user)
    {
        $rol = request()->rol;
        $user->rol = $rol;
        $user->save();

        return response()->json(['message' => 'User converted successfully.'], 200);
    }
}
