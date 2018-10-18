<?php

namespace App\Http\Controllers;

use App\Serial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favorites = Auth::user()->favorites()->get();

        $serial = Serial::getRandom();
        return view('home', [
            'random_serial' => $serial,
            'serial' => $serial,
            'favorites' => $favorites,
        ]);
    }
}
