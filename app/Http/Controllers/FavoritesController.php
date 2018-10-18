<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function add($serial_id)
    {
        $user = Auth::user();
        if ($user) {
            $user_id = $user->id;
            $favorite = Favorite::where('user_id', '=', $user_id)->where('serial_id', '=', $serial_id)->get();
            if (count($favorite) == 0) {
                $favorite = new Favorite();
                $favorite->user_id = $user_id;
                $favorite->serial_id = $serial_id;
                $favorite->save();
            } else {
                $favorite[0]->delete();
            }
        }
    }
}
