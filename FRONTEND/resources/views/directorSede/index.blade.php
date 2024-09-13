@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
<section class="director-container">
    <h2>Director de Sede - Gestión de Vigilantes y Usuarios Comunes</h2>
    <button onclick="showModal('create-vigilante')">Crear Vigilante</button>

    <h2>Vigilantes</h2>
    <ul>
        @foreach($vigilantes as $vigilante)
            <li>{{ $vigilante->name }} ({{ $vigilante->id }})</li>
        @endforeach
    </ul>
    <h2>Usuarios Comunes</h2>
    <ul>
        @foreach($usuariosComunes as $usuarioComun)
            <li>{{ $usuarioComun->name }} ({{ $usuarioComun->id }})</li>
        @endforeach
    </ul>
</section>

<section id="create-vigilante-modal" class="modal">
    <article class="modal-content">
        <span class="close" onclick="closeModal('create-vigilante')">&times;</span>
        <h2>Crear Nuevo Vigilante</h2>
        <form action="{{ route('create.vigilante') }}" method="POST">
            @csrf
            <select name="tipo_documento" id="tipo_documento">
                <option value="tarjeta_identidad">Tarjeta De Identidad</option>
                <option value="cedula">Cédula De Ciudadanía</option>
                <option value="otro">Otro</option>
            </select>
            <input type="text" name="documento" placeholder="Documento" required>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellido" placeholder="Apellido" required>

            <button type="submit">Registrar Usuario</button>
        </form>
        @if ($errors->has('registerError'))
        <div>{{ $errors->first('registerError') }}</div>
        @endif

        @if (session('success'))
        <div>{{ session('success') }}</div>
        @endif
    </article>
</section>
{{-- 
<h1>Director de Sede Dashboard</h1>
    
    <form action="{{ route('directorsede.createVigilante') }}" method="post">
        @csrf
        <label for="name">Nombre del Vigilante:</label>
        <input type="text" id="name" name="name">
        <button type="submit">Crear Vigilante</button>
    </form>
    <form action="{{ route('directorsede.createUsuarioComun') }}" method="post">
        @csrf
        <label for="name">Nombre del Usuario Comun:</label>
        <input type="text" id="name" name="name">
        <button type="submit">Crear Usuario Comun</button>
    </form> --}}

<style>
    .director-container {
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

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 60px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 400px;
    }

    .close {
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: red;
    }

</style>

<script>
    function showModal(modalId) {
        document.getElementById(modalId + '-modal').style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId + '-modal').style.display = 'none';
    }

</script>
@endsection
