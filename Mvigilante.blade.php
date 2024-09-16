<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Vigilante</title>
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
            top: 40px;
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
            top: 70px;
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
            background-color: #d95459;
            color: white;
        }
        .content {
            margin-top: 100px;
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
            background-color: #d95459;
            color: white;
        }
        .btn-group {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            width: 70%;
            align-self: flex-end;
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
    <!-- Navbar superior con degradado -->
    <div class="navbar">
        <img src="data:image/png;base64,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">
    </div>

    <!-- Navbar inferior con nombre de usuario -->
    <div class="navbar-user-bar">
        <span class="navbar-title">Bienvenido</span>
        <span>Nombre de usuario</span>
    </div>

    <!-- Navbar para gestión de vigilantes -->
    <div class="navbar-sede-bar">
        <button>Nuevo Vigilante</button>
        <button class="active">Modificar Vigilante</button>
        <button>Eliminar Vigilante</button>
        <button>Lista de Vigilantes</button>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <h1>Modificar Vigilante</h1>
        <form>
            <label for="id">ID:</label>
            <input type="text" id="id" name="id">

            <label for="nombre">Nombre completo:</label>
            <input type="text" id="nombre" name="nombre">

            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula">

            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero">

            <div class="btn-group">
                <button type="submit" class="btn-delete">Actualizar</button>
                <button type="button" class="btn-cancel">Cancelar</button>
            </div>
        </form>
    </div>
</body>
</html>
