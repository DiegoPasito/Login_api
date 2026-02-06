<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1️⃣ Validar datos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2️⃣ Buscar usuario
        $user = User::where('email', $request->email)->first();

        // 3️⃣ Verificar credenciales
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        // 4️⃣ Respuesta correcta
        return response()->json([
            'message' => 'Login exitoso',
            'user' => $user
        ], 200);
    }
}
