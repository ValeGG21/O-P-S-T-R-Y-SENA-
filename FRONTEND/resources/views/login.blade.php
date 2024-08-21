<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>LOGIN</title>
</head>    
<body>
    <div class="caja_1">
        <img src="{{ asset('assets/img/logo.png') }}" class="logo">
        <h1 class="comp1">Bienvenido</h1>
        <p>Inicia Sesión</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-container">
                <input type="text" name="identificacion" placeholder=" ">
                <label for="identificacion">Número de identificación</label>
            </div>
            <div class="input-container">
                <input type="password" name="contraseña" placeholder=" ">
                <label for="contraseña">Contraseña</label>
            </div>
            <input type="submit" value="Ingresar">
        </form>
        <a href="">Olvidaste tu contraseña?</a>
    </div>
</body>
</html>
