<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Album;

class UserController extends Controller
{
    public function perfil () {
        if (Auth::check())
        {
            $user = Auth::user();
            $id = Auth::id();
            $reviews = Review::join('album', 'album.id', '=', 'review.album')
                                ->select('review.id', 'album.imagen', 'album.nombre', 'album.artista', 'album.lanzamiento',
                                 'album.puntuacion', 'album.genero', 'review.review', 'review.valoracion')
                                ->where('review.usuario', $id)->simplePaginate(2);
            $albumes = Album::where('usuario', $id)->get();

            return view('albumes.perfil')->with(['usuario' => $user, 'reviews' => $reviews, 'albumes' => $albumes]);
        } else 
        {
            return redirect()->route('login');
        }
    }

    public function modificar_perfil () {
        $user = Auth::user();

        return view('albumes.modificar_perfil')->with(['usuario' => $user]);
    }

    public function guardar_perfil (Request $request) {
        $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email',
            'edad' => 'required|integer',
            'localizacion' => 'required|string',
        ]);

        $user = Auth::user();
        $user->name = $request['nombre'];
        $user->email = $request['email'];
        $user->edad = $request['edad'];
        $user->localizacion = $request['localizacion'];
        $user->favoritos = $request['favoritos'];
        $user->biografia = $request['biografia'];
        if ($request['image'] != null)
            $user->profile_photo_path = $request['image'];
        
        $user->save();

        return redirect()->route('mostrar_perfil', ['usuario' => $user]);
    }
}
