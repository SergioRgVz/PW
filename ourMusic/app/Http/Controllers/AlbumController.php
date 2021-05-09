<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;

class AlbumController extends Controller
{
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
}
