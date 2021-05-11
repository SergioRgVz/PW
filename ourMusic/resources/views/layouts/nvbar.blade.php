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
            <li><a href="{{ route('inicio') }}">Our Music</a></li>
            <li><a href="{{ route('albumfechaorden') }}">Música nueva</a></li>
            <li><a href="{{ route('albumranking') }}">Top álbumes</a></li>
            <li class="busqueda">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="search" required/>
                    <button type="submit">Búsqueda</button>
                </form>
            </li>
            @if (Auth::check())
                <li style="float:right"><a href="{{route('mostrar_perfil')}}" class="color">{{ $usuario->name }}</a></li>
            @else
                <li style="float:right"><a href="{{route('login')}}">Iniciar sesión</a></li>
            @endif
        </ul>
    </nav>
    <div class="cuerpo">
        @yield('contenido')
    </div>

</body>

</html>