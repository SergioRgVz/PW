<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use App\Models\Review;

class AlbumController extends Controller
{
    public function inicio()
    {
        $user = Auth::user();

        $albumes = Album::orderBy('id','desc')->simplePaginate(3);
        return view('albumes.inicio')->with(['albumes' => $albumes, 'usuario' => $user]);
    }

    public function album(Album $alb)
    {
        $user = Auth::user();

        $reviews = Review::join('users', 'review.usuario', '=', 'users.id')->where('album', $alb->id)->get();
        return view('albumes.ver_album')->with(['album' => $alb, 'reviews' => $reviews, 'usuario' => $user]);
    }

    public function crear_album (){
        $user = Auth::user();

        return view('albumes.nuevo_album', ['usuario' => $user]);
    }

    public function guardar_album (Request $request){
        $request->validate([
            'nombre' => 'required|string',
            'artista' => 'required|string',
            'genero' => 'required|string',
        ]);

        $user = Auth::user();
        $id = Auth::id();

        $album = new Album;

        $album->nombre = $request['nombre'];
        $album->artista = $request['artista'];
        $album->lanzamiento = $request['lanzamiento'];
        $album->genero = $request['genero'];
        $album->usuario = $id;
        $album->imagen = $request['imagen'];

        $album->save();

        return redirect()->route('mostrar_perfil', ['usuario' => $user]);
    }

    public function eliminar ($id){

        $album = Album::find($id);
        $album->delete();

        $user = Auth::user();
        return redirect()->route('mostrar_perfil', ['usuario' => $user]);
    }

    public function albumranking()
    {
        $albumes = Album::orderBy('puntuacion', 'DESC')->get();

        $user = Auth::user();

        return view('albumes.albumrankingorder')->with(['album' => $albumes, 'usuario' => $user]);
    }

    public function albumfechaorden()
    {
        $albumes = Album::orderBy('lanzamiento','DESC')->get();

        $user = Auth::user();

        return view('albumes.albumfechaorden')->with(['album' => $albumes, 'usuario' => $user]);
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

        $user = Auth::user();

        return view('albumes.search', with(['album' => $albumes, 'usuario' => $user]));
    }
}
