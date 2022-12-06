<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = auth()->user()->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Login Successful',
                'token' => $token,
            ], 200);
        }
        return response()->json(['message' => 'Login Failed'], 401);
    }
    function logout(){
        auth()->user()->currentAccessToken()->delete();
    }
}
