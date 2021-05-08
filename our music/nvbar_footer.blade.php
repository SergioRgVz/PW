<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
    <title>@yield('titulo')</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="">Our Music</a></li>
            <li><a href="">Música nueva</a></li>
            <li><a href="">Top álbumes</a></li>
            <li style="float:right"><a href="">Perfil</a></li>
        </ul>
    </nav>
    <div class="cuerpo">
        @yield('contenido')
    </div>

    <!-- <footer>
        <p>OUR MUSIC</p>
        <p>&copy 2021</p>
    </footer> -->

</body>

</html>