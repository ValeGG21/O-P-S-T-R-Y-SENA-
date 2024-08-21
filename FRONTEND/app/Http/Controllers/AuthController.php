<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    protected $client;

    public function __construct(){
        $this->client = new Client([
            'base_uri' => env('API_URL')
        ]);
    }

    public function registrar(Request $request){
        $response = $this->client->post('/auth/registrarUsuario', ['json' => $request->all()]);

        $data = json_decode($response->getBody(), true);

        return redirect()->route('login')->with('message', $data['message']);
    }

    public function login(Request $request){
        $response = $this->client->post('auth/iniciarSesion', ['json' => $request->all()]);

        $data = json_decode($response->getBody(), true);

        if(isset($data['token'])){
            session(['jwt_token' => $data['token']]);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['error' => $data['error']]);
    }

    public function logout(){
        session()->forget('jwt_token');
        return redirect()->route('login');
    }

}
