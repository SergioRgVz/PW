@extends('layouts.nvbar_footer')
@section('titulo') {{ $usuario->name }} @endsection

@section('contenido')
    <form method="POST" action="{{route('logout')}}">
            @csrf

            <x-jet-dropdown-link href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
            <img alt="" src="/img/cerrarSesion.png" width="45" height="30"/>
            </x-jet-dropdown-link>
    </form>

    <p>{{ $usuario->name }}</p>
    <p>{{ $usuario->edad }} | {{ $usuario->localizacion }}</p>
    <p>{{ $usuario->favoritos }}</p>
    <p>{{ $usuario->biografia }}</p>
@endsection