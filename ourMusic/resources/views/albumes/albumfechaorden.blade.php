@extends('layouts.nvbar')

@section('titulo')
ourMusic - Música nueva @endsection

@section('contenido')
    <body class = "antialiased">
        <h1>Últimos álbumes</h1>
        <hr>

        @php $cont=1 @endphp

        @foreach($album as $fila)
        <div class = "alinear">

            <p><h1 class="margen">{{ $cont }}</h1></p>
            
            <p><a href="{{ route('album',['alb'=>$fila->id]) }}"><img class="margen" src="img/{{$fila->imagen}}" width = "200" height = "200" alt = ""></a></p>
            
            <div>
                <h3><a class ="color" href="{{ route('album',['alb'=>$fila->id]) }}">{{ $fila->nombre }}</a></h3>
                <p class ="color">{{$fila->artista}}</p>
                <p>Fecha de lanzamiento: {{ $fila->lanzamiento }}</p>

                <p>Puntuación: {{ $fila->puntuacion}}</p>
                <p>Género: {{$fila->genero}}</p> <br>
            </div>

        </div>
             
            <br>
            <br>
            <hr>

            @php $cont = $cont + 1 @endphp

        @endforeach

@endsection