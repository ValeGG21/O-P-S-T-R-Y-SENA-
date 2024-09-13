@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
<section class="caja2">
    @include('layouts.fragments.navbar')

    <h2>SuperAdmin - Gestión de Sedes y Directores de Sede</h2>
    <article class="input-container">
        <input type="text" name="buscador" placeholder="Buscar registro">
        <img src="{{ asset('assets/img/buscar.png') }}" alt="Buscar" class="lupa">
    </article>

    <div class="container">
        <div class="btn-group">
            <button id="sedesBtn" onclick="mostrarTabla('sedes')" class="btn">Sedes</button>
            <button id="directoresBtn" onclick="mostrarTabla('directores')" class="btn">Directores</button>
            <button onclick="showModal('create-sede')" class="btn">Crear Sede</button>
            <button onclick="showModal('create-director')" class="btn">Crear Director</button>
        </div>

        <div id="tablaSedes" class="tabla-contenedor">
            <table>
                <thead>
                    <tr>
                        <th>Departamento</th>
                        <th>Ciudad</th>
                        <th>Nombre de Sede</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sedes as $sede)
                    <tr>
                        <td>{{ $sede->departamento }}</td>
                    <td>{{ $sede->ciudad }}</td>
                    <td>{{ $sede->nombre }}</td>
                    <td>
                        <button>Editar</button>
                        <button>Eliminar</button>
                    </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button>Editar</button>
                            <button>Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="tablaDirectores" class="tabla-contenedor" style="display:none;">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Sede Asignada</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($directores as $director)
                    <tr>
                        <td>{{ $director->nombre }}</td>
                    <td>{{ $director->numero_documento }}</td>
                    <td>{{ $director->sede->nombre }}</td>
                    <td>
                        <button>Editar</button>
                        <button>Eliminar</button>
                    </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button>Editar</button>
                            <button>Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>



</section>

<!-- Pop-up de confirmación -->
<section id="logoutPopup" class="popup">
    <article class="popup-content">
        <p id="p">¿Estás seguro de cerrar sesión?</p>
        <button onclick="confirmLogout()" class="confirm">Sí</button>
        <button onclick="hidePopup()" class="cancel">No</button>
    </article>
</section>

<section id="create-sede-modal" class="modal">
    <article class="modal-content">
        <span class="close" onclick="closeModal('create-sede')">&times;</span>
        <h2>Crear Nueva Sede</h2>
        <form action="{{ route('superadmin.createSede') }}" method="POST">
            @csrf
            <section class="form-group">
                <label for="departamento">Departamento:</label>
                <select id="departamento" name="departamento">
                    <option value="all">Todos los departamentos</option>
                    @foreach($departamentos_ciudades as $item)
                    <option value="{{ $item['departamento'] }}">{{ $item['departamento'] }}</option>
                    @endforeach
                </select>
                <label for="ciudad">Ciudad:</label>
                <select id="ciudad" name="ciudad">
                    <option value="all">Todas las ciudades</option>
                    @foreach($departamentos_ciudades as $item)
                    @foreach($item['ciudades'] as $ciudad)
                    <option data-departamento="{{ $item['departamento'] }}" value="{{ $ciudad }}">{{ $ciudad }}</option>
                    @endforeach
                    @endforeach
                </select>
                <label for="nombre">Nombre de la Sede</label>
                <input type="text" name="nombre" id="nombre" required>
            </section>
            <button type="submit">Crear</button>
        </form>
    </article>
</section>

<section id="create-director-modal" class="modal">
    <article class="modal-content">
        <span class="close" onclick="closeModal('create-director')">&times;</span>
        <h2>Crear Nuevo Director de Sede</h2>
        <form action="{{ route('superadmin.createDirectorSede') }}" method="POST">
            @csrf
            <section class="form-group">
                <select name="tipo_documento" id="tipo_documento">
                    <option value="all">Tipo De Documento</option>
                    <option value="TI">Tajeta De Identidad</option>
                    <option value="CC">Cédula De Ciudadanía</option>
                    <option value="OT">Otro</option>
                </select>
                <label for="numero_documento">Número de Documento</label>
                <input type="text" name="numero_documento" id="numero_documento" required>
                <label for="nombre">Nombres</label>
                <input type="text" name="nombre" id="nombre" required>
                <label for="apellido">Apellidos</label>
                <input type="text" name="apellido" id="apellido" required>
                <label for="sede_id">Sede</label>
                <input type="text" name="sede_id" id="sede_id" value="i" disabled>
                <input type="text" name="sede_id" id="sede_id" value="i" hidden>
                <label for="rol">Rol</label>
                <input type="text" name="rol" id="rol" value="Director De Sede" disabled>
                <input type="text" name="rol" id="rol" value="DirectorSede" hidden>
                <label for="novedad">Novedad</label>
                <textarea name="novedad" id="novedad" cols="30" rows="4">Creación de director por parte del super administrador.   </textarea>
            </section>
            <button type="submit">Crear</button>
        </form>
    </article>
</section>


<script src="{{ asset('assets/js/script.js') }}"></script>
<script>
    function showModal(modalId) {
        document.getElementById(modalId + '-modal').style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId + '-modal').style.display = 'none';
    }

    const selectDepartamento = document.getElementById('departamento');
    const selectCiudad = document.getElementById('ciudad');
    const ciudadOptions = Array.from(selectCiudad.options); // Todas las opciones originales de ciudades

    // Evento para cambiar las ciudades según el departamento seleccionado
    selectDepartamento.addEventListener('change', function() {
        const selectedDepartamento = this.value;

        // Limpiar el select de ciudades
        selectCiudad.innerHTML = '';

        if (selectedDepartamento === 'all') {
            // Si no hay un departamento seleccionado, mostrar todas las ciudades
            ciudadOptions.forEach(option => {
                selectCiudad.appendChild(option);
            });
        } else {
            // Mostrar solo las ciudades del departamento seleccionado
            ciudadOptions.forEach(option => {
                if (option.getAttribute('data-departamento') === selectedDepartamento) {
                    selectCiudad.appendChild(option);
                }
            });
        }
    });

    // Evento para seleccionar el departamento según la ciudad seleccionada
    selectCiudad.addEventListener('change', function() {
        const selectedCiudad = this.value;

        // Buscar el departamento asociado a la ciudad seleccionada
        ciudadOptions.forEach(option => {
            if (option.value === selectedCiudad) {
                const departamentoAsociado = option.getAttribute('data-departamento');
                selectDepartamento.value = departamentoAsociado; // Selecciona el departamento correspondiente

                // Actualizar el select de ciudades para mostrar solo las ciudades del departamento correspondiente
                selectDepartamento.dispatchEvent(new Event('change'));
            }
        });
    });

    function mostrarTabla(tabla) {
        // Oculta ambas tablas
        document.getElementById('tablaSedes').style.display = 'none';
        document.getElementById('tablaDirectores').style.display = 'none';

        // Muestra la tabla correspondiente
        if (tabla === 'sedes') {
            document.getElementById('tablaSedes').style.display = 'block';
        } else if (tabla === 'directores') {
            document.getElementById('tablaDirectores').style.display = 'block';
        }
    }

</script>

@endsection
