<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    // Aquí puedes manejar la lógica de autenticación
    $credentials = $request->only('identificacion', 'contraseña');

    // Por ejemplo, aquí puedes intentar autenticar al usuario (esto es solo un ejemplo):
    // if (Auth::attempt(['identificacion' => $credentials['identificacion'], 'password' => $credentials['contraseña']])) {
    //     // Autenticación exitosa
    //     return redirect()->intended('dashboard');
    // } else {
    //     // Autenticación fallida
    //     return redirect('/login')->withErrors(['login_failed' => 'Credenciales inválidas']);
    // }

    // Por ahora, solo devolveremos los datos recibidos para verificar que el formulario funciona
    return $request->all();
});

Route::get('/info', function () {
    return view('info');
})->name('info');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Redirige al login después de cerrar sesión
})->name('logout');