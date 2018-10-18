<?php

namespace App\Http\Controllers;

use App\Serial;
use App\SerialComparer;

class indexController extends Controller
{
    public function __invoke()
    {
        $attributes = SerialComparer::getAttributes();

        $mixes_settings = [];

        $roll_ration = count($attributes)-1;
        for ($i=0; $i<3; $i++) {
            $roll_1 = rand(0, $roll_ration);
            do  {
                $roll_2 = rand(0, $roll_ration);
            } while ($roll_1 == $roll_2);
            $name_one = array_slice($attributes, $roll_1, 1);
            $name_two = array_slice($attributes, $roll_2, 1);
            $titles = [];
            $attrs = [];
            foreach ($name_one as $attr => $title) {
                $titles[] = $title;
                $attrs[] = $attr;
            }
            foreach ($name_two as $attr => $title) {
                $titles[] = $title;
                $attrs[] = $attr;
            }
            $mixes_settings[$titles[0].' + '.$titles[1]] = $attrs;
        }

        $mixes = [];
        $threshold = 8;
        foreach ($mixes_settings as $title => $ms) {
            $mixes[$title] = $this->getMix($ms, $threshold);
        }

        $check = true;
        $offset = 1;
        do {
            foreach ($mixes as $title => $mix) {
                if (count($mix) !== 3) {
                    $check = false;
                    $exclude = false;
                    foreach ($mix as $m) {
                        $exclude[] = $m['id'];
                    }
                    $new_mixes = $this->getMix($mixes_settings[$title], $threshold, $offset, 3-count($mix), $exclude);
                    $mixes[$title] = array_merge($mix, $new_mixes);
                }
            }
            $offset++;
        } while (!$check && (($threshold - $offset) > 0));

        $serial = Serial::getRandom();

        return view('index', ['mixes' => $mixes, 'random_serial' => $serial]);
    }

    private function getMix($data, $threshold, $offset = 0, $limit=3, $exclude = false) {
        $mix = Serial::where('id', '>', 0);
        foreach ($data as $param) {
            $mix->where($param, '>=', $threshold - $offset);
        }
        if ($exclude !== false) {
            $mix->whereNotIn('id', $exclude);
        }
        return $mix->inRandomOrder()->limit($limit)->get()->toArray();
    }
}
