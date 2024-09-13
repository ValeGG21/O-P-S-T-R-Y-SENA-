<?php


namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $registrosEquipo = Equipo::where('usuario_comun_id', auth()->user()->id)->get();
        return view('usuariocomun.index', compact('registrosEquipo'));
    }
}
