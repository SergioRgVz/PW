<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    public function eliminar ($id){

        $review = Review::find($id);
        $review->delete();

        $user = Auth::user();
        return redirect()->route('mostrar_perfil', ['usuario' => $user]);
    }
}
