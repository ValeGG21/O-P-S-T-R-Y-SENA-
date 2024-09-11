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
    <button onclick="showModal('create-sede')">Crear Sede</button>
    <button onclick="showModal('create-director')">Crear Director de Sede</button>

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
        <form action="{{ route('create.sede') }}" method="POST">
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
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <section class="form-group">
                <label for="nombre">Nombre del Director</label>
                <input type="text" name="nombre" id="nombre" required>
            </section>
            <button type="submit">Crear</button>
        </form>
    </article>
</section>

<style>
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

</script>
@endsection
