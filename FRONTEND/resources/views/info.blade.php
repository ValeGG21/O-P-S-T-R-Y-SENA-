<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/styleInfo.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">
    <title>INFO</title>
</head>
<body>
    <div class="caja2">
        <nav>
            <ul>
                <li><a href="#" id="cer" onclick="showPopup()">Cerrar sesión</a></li>
            </ul>
        </nav>
        <h2>Información registrada</h2>
        <div class="input-container">
            <input type="text" name="buscador" placeholder="Buscar registro">
            <img src="{{ asset('assets/img/buscar.png') }}" alt="Buscar" class="lupa">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nro. registro</th>
                    <th>Nro. Dispositivos</th>
                    <th>Caracteristicas</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pop-up de confirmación -->
    <div id="logoutPopup" class="popup">
        <div class="popup-content">
            <p id="p">¿Estás seguro de cerrar sesión?</p>
            <button onclick="confirmLogout()" class="confirm">Sí</button>
            <button onclick="hidePopup()" class="cancel">No</button>
        </div>
    </div>

    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
