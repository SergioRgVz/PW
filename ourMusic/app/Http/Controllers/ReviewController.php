<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Album;

class ReviewController extends Controller
{
    public function eliminar ($id){

        $review = Review::find($id);
        $review->delete();

        $user = Auth::user();
        return redirect()->route('mostrar_perfil', ['usuario' => $user]);
    }

    public function guardarReview(Request $request)
    {
        if(Auth::check())
        {
            $request->validate([
                'valoracion' => 'required|integer',
                'review' => 'required|string'
            ]);

            $review = new Review;
            $id = $request['id'];

            $album = Album::find($id);
            $n_rev = Review::where('album', $id)->count();
            $suma = Review::where('album', $id)->sum('valoracion');
            $rate = ($suma+$request['valoracion'])/($n_rev+1);
            $album->puntuacion = $rate;

            $user = Auth::user();
            $user_id = Auth::id();

            $review->usuario = $user_id;
            $review->album = $id;
            $review->review = $request['review'];
            $review->valoracion = $request['valoracion'];

            $review->save();
            $album->save();

            return redirect()->route('album', ['alb' => $id, 'usuario' => $user]);
        }
        else
            return redirect()->route('login');
    }
}
