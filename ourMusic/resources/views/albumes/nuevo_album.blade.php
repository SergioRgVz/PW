@extends('layouts.nvbar_footer')
@section('titulo') Crear álbum @endsection

@section('contenido')
    <header>
        <h2>Publicar nuevo álbum</h2>
    </header>

    <br><br>

    <form method="POST" action="{{route('guardar_album')}}">
        @csrf
    
        <label id="nombre">Nombre</label>
        <p><input type="text" name="nombre" id="nombre" required></p><br>
        <label id="artista">Artista</label>
        <p><input type="text" name="artista" id="artista" required></p><br>
        <label id="lanzamiento">Fecha de lanzamiento</label>
        <p><input type="date" name="lanzamiento" id="lanzamiento" required></p><br>
        <label id="genero">Género</label>
        <p><input type="text" name="genero" id="genero" required></p><br>
        <label id="imagen">Imágen</label>
        <p><input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg, image/jpg"></p><br>
        <button type="submit">Publicar</button>
    </form><br>
@endsection