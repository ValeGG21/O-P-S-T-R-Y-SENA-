<?php

namespace App\Http\Controllers;

use App\Models\User;
use Http;
use Illuminate\Http\Request;
use App\Models\Sede;
use Session;

class SuperAdminController extends Controller
{
    public function index(Request $request)
    {
        if (Session::get('rol') == 'SuperAdmin') {
            $sedes = Http::post('http://localhost:3000/sedes')->json();
            $directores = Http::post('http://localhost:3000/auth')->json();
            $departamentos_ciudades = $this->getDepartamentosCiudades();

            $response = Http::post('http://localhost:3000/auth/perfil', [
                'id' => Session::get('id_usuario'),
            ]);

            $infoUsuario = $response->json();
            
            return view('SuperAdmin.index', [
                'sedes' => $sedes, 
                'directores' => $directores, 
                'departamentos_ciudades' => $departamentos_ciudades, 
                'Usuario' => $infoUsuario
            ]);
        }
        return redirect()->route('login')->withErrors(['loginError' => 'Rol no autorizado.']);
    }

    // Métodos para crear, actualizar y eliminar sede y director...
    
    private function getDepartamentosCiudades()
    {
        $api = Http::withoutVerifying()->get('https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.min.json')->json();

        return collect($api)->map(function ($item) {
            return [
                'departamento' => $item['departamento'],
                'ciudades' => $item['ciudades'],
            ];
        });
    }
}
