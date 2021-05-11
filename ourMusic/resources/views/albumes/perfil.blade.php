@extends('layouts.nvbar')
@section('titulo') ourMusic - Perfil: {{ $usuario->name }} @endsection

@section('contenido')
    <form method="POST" action="{{route('logout')}}" style="float:right">
            @csrf

            <x-jet-dropdown-link href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
            <img alt="" src="/img/cerrarSesion.png" width="30" height="30"/>
            </x-jet-dropdown-link>
    </form>

    <header>
        <h1>Perfil</h1>
    </header>

    <div class="alinear">
        <p><img class="margen" src="img/{{$usuario->profile_photo_path}}" width="200" height="200" alt=""></p>
        <div>
            <p>{{ $usuario->name }}</p>
            <p>{{ $usuario->edad }} | {{ $usuario->localizacion }}</p>
            <h3 class="color">Artistas favoritos</h3>
            <p>{{ $usuario->favoritos }}</p>
            <h3 class="color">Biografía</h3>
            <p>{{ $usuario->biografia }}</p><br>
            <form action="{{route('modificar_perfil')}}">
                <button type="submit">Modificar datos</button>
            </form>
        </div>
    </div>

    <br><br>

    <h2>Reseñas realizadas</h2>
    @foreach($reviews as $review)
        <form method="POST" action="{{route('eliminar_review', [$review->id])}}">
            @csrf
            @method('DELETE')
            <div class="alinear">
                <p><img class="margen" src='img/{{$review->imagen}}' width="200" height="200" alt=''></p>
                <div>
                    <h3 class="color">{{ $review->nombre }}</h3>
                    <p class="color">{{ $review->artista }}</p>
                    <p>Fecha de lanzamiento: {{ $review->lanzamiento }}</p>
                    <p>Puntuación: {{ $review->puntuacion }}</p>
                    <p>Género: {{ $review->genero }}</p><br>
                </div>
            </div>
            @if($review->valoracion == 1)
                <img src="{{asset('img/1star.png') }}" alt="Portada album">
            @elseif($review->valoracion == 2)
                <img src="{{asset('img/2star.png') }}" alt="Portada album"> 
            @elseif($review->valoracion == 3)
                <img src="{{asset('img/3star.png') }}" alt="Portada album"> 
            @elseif($review->valoracion == 4)
                <img src="{{asset('img/4star.png') }}" alt="Portada album"> 
            @else
                <img src="{{asset('img/5star.png') }}" alt="Portada album"> 
            @endif

            <p>{{ $review->review }}</p><br>
            <button type="submit">Eliminar</button>
        </form><br><br>
        <hr>
        <br>
    @endforeach

    <br>

    {{ $reviews->render() }}

    <br><br>

    <h2>Álbumes publicados</h2>
    <br><form action="{{route('crear_album')}}">
        <button type="submit">Publicar nuevo álbum</button>
    </form><br><br>

    <hr>

    <br>

    @foreach($albumes as $album)
        <form method="POST" action="{{route('eliminar_album', [$album->id])}}">
            @csrf
            @method('DELETE')

            <div class="alinear">
                <p><a href="{{ route('album',['alb'=>$album->id]) }}"><img class="margen" src='img/{{$album->imagen}}' width="200" height="200" alt=''></a></p>
                <div>
                    <h3><a class="color" href="{{ route('album',['alb'=>$album->id]) }}">{{ $album->nombre }}</a></h3>
                    <p class="color">{{ $album->artista }}</p>
                    <p>Fecha de lanzamiento: {{ $album->lanzamiento }}</p>
                    <p>Puntuación: {{ $album->puntuacion }}</p>
                    <p>Género: {{ $album->genero }}</p>
                </div>
            </div>
            <button type="submit">Eliminar</button>
        </form><br><br>
        <hr>
        <br>
    @endforeach

@endsection