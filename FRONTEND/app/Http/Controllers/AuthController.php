<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('documento', 'contra');

        $response = Http::post('http://localhost:3000/auth/login', [
            'documento' => $credentials['documento'],
            'password' => $credentials['contra'],
        ]);

        if ($response->successful()) {
            $user = $response->json();

            session(['user' => $user]);

            switch ($user['rol']) {
                case 'superAdmin':
                    return redirect()->route('superAdmin.index');
                case 'director_sede':
                    return redirect()->route('directorSede.index');
                case 'vigilante':
                    return redirect()->route('vigilante.index');
                case 'usuario_comun':
                    return redirect()->route('usuarioComun.index');
                default:
                    return redirect('/login');
            }
        }

        return redirect()->back()->withErrors(['loginError' => 'Número de identificación o contraseña incorrectos']);
    }

    public function logout(Request $request)
    {
        session()->forget('user');
        return redirect('/login');
    }
}

