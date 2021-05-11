@extends('layouts.nvbar')


@section('titulo')
ourMusic - Busqueda @endsection

@section('contenido')


@if($album->isNotEmpty())
@foreach($album as $fila)

<div class = "alinear">
            
            <p><a href="{{ route('album',['alb'=>$fila->id]) }}"><img class="margen" src='img/{{$fila->imagen}}' width = "200" height = "200" alt = ''></a></p>
            

            <div>
            <h3><a class ="color" href="{{ route('album',['alb'=>$fila->id]) }}">{{ $fila->nombre }}</a></h3>
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