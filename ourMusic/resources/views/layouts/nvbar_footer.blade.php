<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link href="{{asset('css/estilos.css')}}" rel="stylesheet" type="text/css">
    <title>@yield('titulo')</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="">Our Music</a></li>
            <li><a href="">Música nueva</a></li>
            <li><a href="">Top álbumes</a></li>
            <li style="float:right"><a href="{{route('login')}}">Iniciar sesión</a></li>
            <li style="float:right"><a href="{{route('mostrar_perfil')}}">Perfil</a></li>
        </ul>
    </nav>
    <div class="cuerpo">
        @if (Auth::check())
            <p>Se ha iniciado sesión como <span class="color">{{ $usuario->name }}<span></p>
        @endif
        @yield('contenido')
    </div>

    <!-- <footer>
        <p>OUR MUSIC</p>
        <p>&copy 2021</p>
    </footer> -->

</body>

</html>