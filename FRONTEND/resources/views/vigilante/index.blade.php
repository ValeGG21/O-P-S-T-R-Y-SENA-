@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
<div class="vigilante-container">
    <h2>Vigilante - Gestión de Usuarios Comunes y Equipos</h2>
    <button onclick="showModal('create-usuario')">Registrar Usuario Común</button>
    <button onclick="showModal('create-equipo')">Registrar Equipo</button>

    <h2>Registros de Equipos</h2>
    <ul>
        @foreach($registrosEquipo as $registroEquipo)
            <li>Equipo {{ $registroEquipo->equipo_id }} ({{ $registroEquipo->id }})</li>
        @endforeach
    </ul>
</div>
<section class="modal" id="create-equipo-modal">
    <form method="POST" action="{{ route('vigilante.createRegistroEquipo') }}">
        @csrf
        <input type="text" name="marca" placeholder="Marca del Equipo" required>
        <input type="text" name="descripcion" placeholder="Descripción" required>
        <input type="text" name="usuario_id" placeholder="ID del Usuario" required>
        <button type="submit">Registrar Equipo</button>
    </form>

    @if ($errors->has('registerError'))
    <section>{{ $errors->first('registerError') }}</section>
    @endif

    @if (session('success'))
    <section>{{ session('success') }}</section>
    @endif
</section>



<style>
    .vigilante-container {
        max-width: 800px;
        margin: 0 auto;
    }

    button {
        padding: 10px 20px;
        margin: 10px 0;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

</style>
@endsection
