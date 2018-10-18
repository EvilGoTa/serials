<?php

namespace App\Http\Controllers;

use App\Serial;
use App\Mark;
use App\SerialComparer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class serialFrontController extends Controller
{
    public function index($id) {
        $serial = Serial::findOrFail($id);

        $attributes = SerialComparer::getAttributes();

        $values = [];
        foreach ($attributes as $name => $ru_name) {
            $values[$name] = $serial->{$name};
        }

        arsort($values);
        $values = array_slice($values, 0, 5);

        $max = [];
        foreach ($values as $attr => $val) {
            $max[] = array('attribute' => $attr, 'value' => $val);
        }

        // похожие
        $comparer = new SerialComparer($serial);
        $similar = $comparer->findSimilar(6);

        // в избранном?
        $user = Auth::user();
        if ($user) {
            $favorites = $favorites = $user->favorites()->where('serials.id', '=', $id)->get()->toArray();
            $marks = $user->marks()->where('serial_id', '=', $id)->get()->toArray();
        } else {
            $favorites = $marks = [];
        }

        return view('serial', [
            'serial' => $serial,
            'random_serial' => Serial::whereRaw('image <> ""')->inRandomOrder()->take(1)->get()->first(),
            'attributes' => $attributes,
            'max_attrs' => $max,
            'similar_data' => $similar,
            'favorite' => count($favorites)?'active':'',
            'user_marks' => $marks,
        ]);
    }

    public function setMark(Request $request, $id) {
        $user = Auth::user();
        if ($user) {
            $val = $request->get('mark');
            $question = $request->get('question');
            $user = $user->id;

            $markCollection = Mark::where('user_id', $user)
                ->where('serial_id', $id)
                ->where('question_id', $question)
                ->get();

            $mark = $markCollection->first();
            if ($mark !== null) {
                $mark->mark_value = $val;
                $mark->save();
            } else {
                $mark = new Mark;
                $mark->user_id = $user;
                $mark->serial_id = $id;
                $mark->question_id = $question;
                $mark->mark_value = $val;
                $mark->save();
            }
        }
    }
}
