@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
<div class="usuario-container">
    <h2>Usuario Común - Información Personal y Equipos</h2>

    <ul>
        @foreach($registrosEquipo as $registroEquipo)
            <li>Equipo {{ $registroEquipo->equipo_id }} ({{ $registroEquipo->id }})</li>
        @endforeach
    </ul>
</div>

<style>
    .usuario-container {
        max-width: 800px;
        margin: 0 auto;
    }
</style>
@endsection