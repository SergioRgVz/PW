@extends('layouts.nvbar_footer')
@section('titulo') Modificar perfil: {{ $usuario->name }} @endsection

@section('contenido')
    <header>
        <h2>Modificar datos del perfil</h2>
    </header>

    <form method="POST" action="{{route('guardar_perfil')}}">
        @csrf

        <label id="imagen_perfil">Foto</label>
        <p><img src='img/{{$usuario->profile_photo_path}}' width="200" height="200" alt='' id="imagen_perfil" name="imagen_perfil"></p>
        <p><input type="file" name="image" accept="image/png, image/jpeg, image/jpg"></p><br>
        <label id="nombre">Nombre</label>
        <p><input type="text" name="nombre" value="{{ $usuario->name }}"></p><br>
        <label id="email">Correo</label>
        <p><input type="email" name="email" value="{{ $usuario->email }}"></p><br>
        <label id="edad">Edad</label> | <label id="localizacion">Localización</label>
        <p><input type="number" name="edad" value="{{ $usuario->edad }}"> | <input type="text" name="localizacion" value="{{ $usuario->localizacion }}"></p><br>
        <label id="favoritos">Artistas favoritos</label>
        <p><textarea name="favoritos" id="favoritos" rows="5" cols="80">{{ $usuario->favoritos }}</textarea></p>
        <label id="biografia">Biografía</label>
        <p><textarea name="biografia" id="biografia" rows="5" cols="80">{{ $usuario->biografia }}</textarea></p>
        <button type="submit">Guardar</button>
    </form><br>
@endsection