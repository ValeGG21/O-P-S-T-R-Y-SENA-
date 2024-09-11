@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
<div class="usuario-container">
    <h2>Usuario Común - Información Personal y Equipos</h2>

    <h3>Información Personal</h3>
    <!-- Información personal -->

    <h3>Equipos Registrados</h3>
    <!-- Lista de equipos registrados -->
</div>

<style>
    .usuario-container {
        max-width: 800px;
        margin: 0 auto;
    }
</style>
@endsection