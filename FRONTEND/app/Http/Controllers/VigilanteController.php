<?php

namespace App\Http\Controllers;

// front/app/HTTP/Controllers/VigilanteController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class VigilanteController extends Controller
{
    public function index()
    {
        $registrosEquipo = Equipo::where('vigilante_id', auth()->user()->id)->get();
        return view('vigilante.index', compact('registrosEquipo'));
    }

    public function createRegistroEquipo(Request $request)
    {
        $registroEquipo = new Equipo();
        $registroEquipo->vigilante_id = auth()->user()->id;
        $registroEquipo->equipo_id = $request->input('equipo_id');
        $registroEquipo->save();
        return redirect()->route('vigilante.index');
    }
}