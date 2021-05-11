@extends('layouts.nvbar')

@section('titulo') ourMusic - {{$album->nombre}} @endsection

@section('contenido')

<div class="sombreado">
<h1 style="color: #3b83bd">{{$album->nombre}}</h1>   

<img src="{{ asset('/img/'.$album->imagen) }}" alt="Portada album" title="Portada album " width="350" height="350"> 
<h2>{{$album->artista}}</h3>
<h3>Fecha de lanzamiento: {{$album->lanzamiento}}</h3>
<p>Puntuación: {{$album->puntuacion}}</p>
<h3>Género:</h3>
<p>{{$album->genero}}</p>
</div>
<!-- Seccion de Reviews -->
<h2 style="color: #3b83bd">Reseñas</h2>

<form action="{{route('guardarReview')}}" method="POST" style="padding: 10px 10px 10px 10px">
    {{csrf_field()}}

    <div>
        <h3>Valoración</h3>

        <input name="valoracion" value="1" type="radio" name="punt-1" id="punt-1">
        <label for="punt-1">1</label>

        <input name="valoracion" value="2" type="radio" name="punt-2" id="punt-2">
        <label for="punt-2">2</label>

        <input name="valoracion" value="3" type="radio" name="punt-3" id="punt-3">
        <label for="punt-3">3</label>

        <input name="valoracion" value="4" type="radio" name="punt-4" id="punt-4">
        <label for="punt-4">4</label>

        <input name="valoracion" value="5" type="radio" name="punt-5" id="punt-5">
        <label for="punt-5">5</label>
    </div>


    <!-- Review -->
    <div style="padding-top:10px">
        <h3>Reseña</h3>
        <textarea name="review"  cols="100" rows="15" class="form_control" placeholder="Introduce tu reseña aquí..." required></textarea>
    </div>

    <input type="hidden" name="id" value="{{$album->id}}">

    <button type="submit">Añadir Reseña</button>
</form><br>


@foreach($reviews as $fila)

    <h3>{{$fila->name}}</h3>

    @if($fila->valoracion == 1)
        <img src="{{asset('img/1star.png') }}" alt="Portada album">
    @elseif($fila->valoracion == 2)
        <img src="{{asset('img/2star.png') }}" alt="Portada album"> 
    @elseif($fila->valoracion == 3)
        <img src="{{asset('img/3star.png') }}" alt="Portada album"> 
    @elseif($fila->valoracion == 4)
        <img src="{{asset('img/4star.png') }}" alt="Portada album"> 
    @else
        <img src="{{asset('img/5star.png') }}" alt="Portada album"> 
    @endif

    <p>{{$fila->review}}</p>
    <br>
        
@endforeach

@endsection