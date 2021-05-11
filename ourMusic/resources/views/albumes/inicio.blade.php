@extends('layouts.nvbar')

@section('titulo') Our Music - Página de inicio @endsection

@section('contenido')

<h1 style="text-align: center">Listado de álbumes</h1>
<br><br>
<div class="grid-container">
@foreach($albumes as $fila)
    <div class="sombreado" >
    <br>
    <a href="{{ route('album',['alb'=>$fila->id]) }}", title="Ver album"> 
    <img src="img/{{$fila->imagen}}" alt="Portada album" title="Portada album" width="250" height="250"> 
    </a> 
    <a href="{{ route('album',['alb'=>$fila->id]) }}", title="Ver album">
    <h2 style="color: #3b83bd">{{$fila->nombre}}</h2>
    </a>
    <h3 style="color: #3b83bd">{{$fila->artista}}</h3>
    <h3> Fecha de lanzamiento: {{$fila->lanzamiento}}</h3>
    <p>Puntuación: {{$fila->puntuacion}}</p>
    <h3>Género:</h3>
    <p>{{$fila->genero}}</p>
    </div>
@endforeach
</div>
<br><br>
{{$albumes->render()}}
<br><br>
@endsection