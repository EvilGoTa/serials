<?php

namespace App\Http\Controllers;

use App\Serial;
use App\SerialComparer;
use Illuminate\Http\Request;

class paramsController extends Controller
{
    public function index(Request $req)
    {
        return view('params', [
            'title' => 'Подбор сериалов по параметрам',
            'form_id' => 'paramsForm2',
            'random_serial' => Serial::getRandom(null),
        ]);
    }

    public function postResult(Request $req)
    {
        $data = $req->get('param');
        $enabled = $req->get('param_enabled');
        $post_data = $data;
        foreach ($data as $key => &$d) {
            if ($enabled[$key] == 0) {
                unset($data[$key]);
            }
        }unset($d);
        
        if (count($data) == 0) {
            $collection = Serial::where('id', '=', -1)->get();    
        } else {
            $comparer = new SerialComparer($data);
            $result = $comparer->findSimilar(15);
            $objects = [];
            foreach ($result as $id => $data) {
                $objects[] = Serial::find($data['id']);
            }
            $collection = collect($objects);
        }

        return view('list', [
            'result' => $collection,
            'random_serial' => Serial::getRandom($collection),
            'title' => 'Результат подбора:',
            'post_data' => $post_data,
            'data' => $data,
            'post_enabled' => $enabled,
        ]);
    }
}
