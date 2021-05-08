@extends('layouts.nvbar_footer')
@section('titulo') Perfil: {{ $usuario->name }} @endsection

@section('contenido')
    <header>
        <h2>Perfil</h2>
    </header>

    <form method="POST" action="{{route('logout')}}">
            @csrf

            <x-jet-dropdown-link href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
            <img alt="" src="/img/cerrarSesion.png" width="30" height="30"/>
            </x-jet-dropdown-link>
    </form>

    <p><img src="img/{{$usuario->profile_photo_path}}" width="200" height="200" alt=""></p>
    <p>{{ $usuario->name }}</p>
    <p>{{ $usuario->edad }} | {{ $usuario->localizacion }}</p>
    <h3>Artistas favoritos</h3>
    <p>{{ $usuario->favoritos }}</p>
    <h3>Biografía</h3>
    <p>{{ $usuario->biografia }}</p><br>
    <form action="{{route('modificar_perfil')}}">
        <button type="submit">Modificar datos</button>
    </form>

    <br><br>

    <h2>Reseñas realizadas</h2>
    @foreach($reviews as $review)
        <form method="POST" action="{{route('eliminar_review', [$review->id])}}">
            @csrf
            @method('DELETE')

            <p><img src='img/{{$review->imagen}}' width="200" height="200" alt=''></p>
            <h3><a href="">{{ $review->nombre }}</a></h3>
            {{ $review->artista }}
            <p>{{ $review->lanzamiento }}</p>
            <p>Puntuación: {{ $review->puntuacion }}</p>
            <p>Género: {{ $review->genero }}</p><br>
            <p>{{ $review->review }}</p><br>
            <button type="submit">Eliminar</button>
        </form><br>
    @endforeach

    <br>

    {{ $reviews->render() }}

    <br><br>

    <h2>Álbumes publicados</h2>
    <form action="{{route('crear_album')}}">
        <button type="submit">Publicar nuevo álbum</button>
    </form>

    @foreach($albumes as $album)
        <form method="POST" action="{{route('eliminar_album', [$album->id])}}">
            @csrf
            @method('DELETE')

            <p><img src='img/{{$album->imagen}}' width="200" height="200" alt=''></p>
            <h3><a href="">{{ $album->nombre }}</a></h3>
            {{ $album->artista }}
            <p>{{ $album->lanzamiento }}</p>
            <p>Puntuación: {{ $album->puntuacion }}</p>
            <p>Género: {{ $album->genero }}</p>
            <button type="submit">Eliminar</button>
            </form><br>
    @endforeach

@endsection