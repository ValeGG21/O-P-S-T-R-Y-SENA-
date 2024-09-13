<?php

// front/app/HTTP/Controllers/DirectorSedeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DirectorSedeController extends Controller
{
    public function index()
    {
        $vigilantes = User::where('sede_id', auth()->user()->sede_id)->get();
        $usuariosComunes = User::where('sede_id', auth()->user()->sede_id)->get();
        return view('directorsede.index', compact('vigilantes', 'usuariosComunes'));
    }

    public function createVigilante(Request $request)
    {
        $vigilante = new User();
        $vigilante->name = $request->input('name');
        $vigilante->sede_id = auth()->user()->sede_id;
        $vigilante->save();
        return redirect()->route('directorsede.index');
    }

    public function updateVigilante(Request $request, $id)
    {
        $vigilante = User::find($id);
        $vigilante->name = $request->input('name');
        $vigilante->save();
        return redirect()->route('directorsede.index');
    }

    public function deleteVigilante($id)
    {
        User::find($id)->delete();
        return redirect()->route('directorsede.index');
    }

    public function createUsuarioComun(Request $request)
    {
        $usuarioComun = new User();
        $usuarioComun->name = $request->input('name');
        $usuarioComun->sede_id = auth()->user()->sede_id;
        $usuarioComun->save();
        return redirect()->route('directorsede.index');
    }

    public function updateUsuarioComun(Request $request, $id)
    {
        $usuarioComun = User::find($id);
        $usuarioComun->name = $request->input('name');
        $usuarioComun->save();
        return redirect()->route('directorsede.index');
    }

    public function deleteUsuarioComun($id)
    {
        User::find($id)->delete();
        return redirect()->route('directorsede.index');
    }
}