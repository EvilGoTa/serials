<?php

namespace App\Http\Controllers;

use App\Serial;
use Illuminate\Http\Request;

class searchController extends Controller
{
    private $perPage = 30;

    public function index(Request $req)
    {
        $query = $req->get('query');
        $page = $req->get('page')?$req->get('page'):1;
        $result = Serial::whereRaw("title_ru LIKE '%$query%' OR title_original LIKE '%$query%'")->get();
        $chunk = $result->forPage($page, $this->perPage);
        if ($result->count() > 0) {
            $random_serial = $result[rand(0, $result->count() - 1)];
        } else {
            $random_serial = Serial::whereRaw('image <> ""')->inRandomOrder()->take(1)->get()->first();
        }

        if ($req->ajax()) {
            return view('components.grid', ['items' => $chunk, 'page' => $page]);
        } else {
            return view('search', [
                'result' => $chunk,
                'random_serial' => $random_serial,
                'query' => $query,
                'founded' => count($result),
                'pages' => floor(count($result)/$this->perPage) + 1,
                'page' => $page]);
        }
    }
}
