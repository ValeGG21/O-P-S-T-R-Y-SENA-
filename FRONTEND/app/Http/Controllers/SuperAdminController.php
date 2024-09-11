<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use App\Models\Sede;
use App\Models\DirectorSede;

class SuperAdminController extends Controller
{
    public function index()
    {
        // Asume que estás obteniendo datos para el SuperAdmin
        $departamentos_ciudades = $this->getDepartamentosCiudades(); // Método para obtener los datos

        return view('superAdmin.index', compact('departamentos_ciudades'));
    }

    public function createSede(Request $request)
    {
        $request->validate([
            'departamento' => 'required|string',
            'ciudad' => 'required|string',
            'nombre' => 'required|string|max:255',
        ]);

        Sede::create([
            'departamento' => $request->departamento,
            'ciudad' => $request->ciudad,
            'nombre' => $request->nombre,
        ]);

        return redirect()->back()->with('success', 'Sede creada correctamente.');
    }

    public function createDirector(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        DirectorSede::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->back()->with('success', 'Director de sede creado correctamente.');
    }

    private function getDepartamentosCiudades()
    {
        $api = Http::withoutVerifying()->get('https://github.com/marcovega/colombia-json/blob/master/colombia.json')->json();

        $departamentos_ciudades = collect($api)->map(function ($item) {
            return [
                'departamento' => $item['departamento'],
                'ciudades' => $item['ciudades'],
            ];
        });

        return $departamentos_ciudades;
    }
}
