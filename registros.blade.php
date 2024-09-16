<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Sedes</title>
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
            background: linear-gradient(to right, #4b0082, #ff0000); /* Degradado de morado a rojo */
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
            justify-content: flex-start;
            position: fixed;
            top: 40px;
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Navbar superior con degradado -->
    <div class="navbar">
        <img src="data:image/png;base64,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">
    </div>

    <div class="navbar-user-bar">
        <span class="navbar-title">Bienvenido</span>
        <span>Nombre de usuario</span>
    </div>

    <div class="navbar-sede-bar">
        <button>Nueva Registro</button>
        <button>Modificar Registro</button>
        <button class="active">Lista de Registros</button>
    </div>

    <div class="content">
        <h1>Lista de Registros</h1>
        <table>
            <tr>
                <th>Documento</th>
                <th>Nombre completo</th>
                <th>Fecha de registro</th>
                <th>No. Dispositivos</th>
                <th>Caracteristicas</th>
                <th>Cod. Barras</th>
            </tr>
        </table>
    </div>
</body>
</html>
