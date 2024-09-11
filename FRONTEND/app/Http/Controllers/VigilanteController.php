<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VigilanteController extends Controller
{
    public function PaginaInicial(Request $request){
        if($request->isMethod('GET')){
            return view('vigilante.index');
        }
    }
}
