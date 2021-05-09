
@extends('layouts.nvbar_footer')


@section('titulo')
ourMusic - Busqueda @endsection

@section('contenido')


@if($album->isNotEmpty())
@foreach($album as $fila)

<div class = "alinear">
            
            <p><img class="imagen" src='img/{{$fila->imagen}}' width = "200" height = "200" alt = '' align="left" float="left"></p>
            

            <div>
            <h3><a class ="color" href="">{{ $fila->nombre }}</a></h3>
            <p class ="color">{{$fila->artista}}</p>
            <p>{{ $fila->lanzamiento }}</p>

            <p>Puntuación: {{ $fila->puntuacion}}</p>
            <p>Género: {{$fila->genero}}</p> <br>
            </div>
        </div>
             
            <br>
            <br>
            <hr>
        @endforeach
@else 
    <div>
        <h2>No posts found</h2>
    </div>
@endif

@endsection