<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('rol')) {
            $rol = Session::get('rol');

            switch ($rol) {
                case 'SuperAdmin':
                    return redirect()->route('superadmin.index');
                case 'DirectorSede':
                    return redirect()->route('director.index');
                case 'Vigilante':
                    return redirect()->route('vigilante.index');
                case 'UsuarioComun':
                    return redirect()->route('usuario.index');
            }
        }

        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'numero_documento' => 'required',
            'contra' => 'required',
        ]);

        try {
            $response = Http::post('http://localhost:3000/auth/login', [
                'numero_documento' => $request->input('numero_documento'),
                'contra' => $request->input('contra')
            ]);

            if ($response->successful()) {
                $data = $response->json();

                session([
                    'token' => $data['token'],
                    'rol' => $data['rol'],
                    'id_usuario' => $data['id_usuario']
                ]);

                return redirect()->route($data['rol'] . '.index');
            } else {
                return redirect()->route('login')->withErrors(['loginError' => 'Error en la respuesta del servidor.']);
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['loginError' => 'Error de servidor: ' . $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
