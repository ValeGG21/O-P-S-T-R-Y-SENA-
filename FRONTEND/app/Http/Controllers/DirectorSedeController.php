<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vigilante;

class DirectorSedeController extends Controller
{
    public function index()
    {
        // Obtener lista de vigilantes y usuarios comunes para el Director de Sede
        // Puedes ajustar según cómo quieras presentar la información
        return view('directorSede.index');
    }

    public function createVigilante(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'required|string',
            'documento' => 'required|string|unique:vigilantes,documento',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
        ]);

        Vigilante::create([
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);

        return redirect()->back()->with('success', 'Vigilante creado correctamente.');
    }
}
