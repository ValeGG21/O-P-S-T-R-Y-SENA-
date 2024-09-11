<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Sede</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .navbar {
            background: linear-gradient(to right, #4b0082, #ff0000);
            height: 40px;
            width: 100%;
            display: flex;
            align-items: center;
            padding: 0 15px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
        }
        .navbar img {
            height: 25px;
        }
        .navbar-title {
            margin-left: 10px;
            font-size: 16px;
            color: black;
        }
        .navbar-user-bar {
            background-color: #f2f2f2;
            height: 30px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 15px;
            position: fixed;
            top: 40px; /* Debajo del navbar superior */
            left: 0;
            z-index: 9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar-user-bar span {
            margin-right: 10px;
            font-size: 14px;
            color: #333;
        }
        .navbar-sede-bar {
            background-color: #f2f2f2;
            height: 30px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 0 15px;
            position: fixed;
            top: 70px; /* Debajo del navbar del usuario */
            left: 0;
            z-index: 8;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar-sede-bar button {
            background-color: #d9d9d9;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            color: black;
            cursor: pointer;
            font-size: 14px;
        }
        .navbar-sede-bar .active {
            background-color: #d95459; /* Botón activo en rojo */
            color: white;
        }
        .content {
            margin-top: 100px; /* Espacio para los navbars */
            width: 85%;
        }
        .content h1 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        label {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }
        input[type="text"] {
            width: 300px;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #d9d9d9;
            border-radius: 5px;
            background-color: #d95459; /* Fondo rosado */
            color: white;
        }
        .search-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .search-group input {
            flex: 1;
        }
        .search-group button {
            margin-left: 10px;
            padding: 8px 10px;
            background: linear-gradient(to right, #4b0082, #ff0000);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-group {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            width: 70%;
            align-self: flex-end; /* Alinea el grupo de botones al 70% del ancho de la pantalla */
        }
        .btn-group button {
            width: 48%;
            padding: 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5px;
        }
        .btn-delete {
            background: linear-gradient(to right, #4b0082, #ff0000);
            color: white;
        }
        .btn-cancel {
            background-color: #ff0000;
            color: white;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <img src="/path-to-your-logo.png">
    </div>

    <div class="navbar-user-bar">
        <span class="navbar-title">Bienvenido</span>
        <span>Nombre de usuario</span>
    </div>

    <!-- Navbar para gestión de sedes -->
    <div class="navbar-sede-bar">
        <button>Nueva Sede</button>
        <button>Modificar Sede</button>
        <button class="active">Eliminar Sede</button>
        <button>Lista de Sedes</button>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <h1>Eliminar Sede</h1>
        <form>
            <label for="id_sede">ID de Sede:</label>
            <input type="text" id="id_sede" name="id_sede">

            <label for="nombre">Nombre de Sede:</label>
            <div class="search-group">
                <input type="text" id="nombre" name="nombre">
                <button type="button">Buscar</button>
            </div>

            <label for="director">Director de Sede:</label>
            <input type="text" id="director" name="director">

            <label for="documento">No. Documento:</label>
            <input type="text" id="documento" name="documento">

            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion">

            <div class="btn-group">
                <button type="submit" class="btn-delete">Eliminar</button>
                <button type="button" class="btn-cancel">Cancelar</button>
            </div>
        </form>
    </div>
</body>
</html>
