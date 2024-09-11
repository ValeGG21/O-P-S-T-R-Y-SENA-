@extends('layouts.app')

@section('titulo', 'Login')

@section('contenido')

<div class="caja_1">  

    <img src="{{ asset('assets/img/logo.png') }}" class="logo">
    <h1 class="comp1">Bienvenido</h1>
    <p>Inicia Sesión</p>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-container">
            <input type="text" name="documento" id="documento">
            <label for="documento">Número de identificación</label>
        </div>
        <div class="input-container">
            <input type="password" name="contra" id="contra">
            <label for="contra">Contraseña</label>
        </div>
        <input type="submit" value="Ingresar">
    </form>
    @if ($errors->has('loginError'))
    <div>{{ $errors->first('loginError') }}</div>
    @endif
    <a href="">Olvidaste tu contraseña?</a>
</div>
@endsection
