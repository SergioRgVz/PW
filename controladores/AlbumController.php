<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function albumranking()
    {
        // $albumes = Album::all();
        $albumes = Album::orderBy('puntuacion', 'DESC')->get();
        return view('albumrankingorder')->with(['album' => $albumes]);
    }

    public function albumfechaorden()
    {
        $albumes = Album::orderBy('lanzamiento','DESC')->get();
        return view('albumfechaorden')->with(['album' => $albumes]);
    }

    public function search(Request $request)
    {
        //Obtener la busqueda realizada
        $search = $request->input('search');

        //Buscar en el nombre y el artista de la tabla albums

        $albumes = Album::query()
            ->where('nombre', 'LIKE', "%{$search}%")
            ->orWhere('artista', 'LIKE', "%{$search}%")
            ->orWhere('genero', 'LIKE', "%{$search}%")
            ->get();

        return view('search', with(['album' => $albumes]));
    }
}


// $usuarios = Usuario::with(['recargas' => function($query)
// {
//     $query->orderBy('fecha_recarga','DESC');

// }])->get();