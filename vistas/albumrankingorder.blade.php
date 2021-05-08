<!DOCTYPE html>
@extends('layouts.nvbar_footer')

@section('titulo')
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <title>Ranking de albumes</title> 
    </head>
@endsection

@section('contenido')
    <body class = "antialiased">
        <h1>Ranking de albumes</h1>
        <h2>Por favor funciona</h2>
        <h3>De verdad te lo pido</h3>

        @foreach($album as $fila)
            <p><img src='img/{{$fila->imagen}}' width = "300" height = "300" alt = '' align="left" float="left"></p>
            <h2>{{ $fila->nombre }}</h2>
            <h2>{{ $fila->artista }}</h2>
            <h1>{{ $fila->lanzamiento }}</h1>
            <h1>{{ $fila->puntuacion}}</h1>
            <br/>
            <hr>
        @endforeach
    </body>

@endsection
</html>