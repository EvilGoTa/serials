<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serial extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    public static function getRandom($result = null)
    {
    	if (isset($result) && $result->count() > 0) {
            $random_serial = $result[rand(0, $result->count() - 1)];
        } else {
            $random_serial = Serial::whereRaw('image <> ""')->inRandomOrder()->take(1)->get()->first();
        }
        return $random_serial;
    }

    public static function getTopAttrs(Serial $serial, $count = 0)
    {
        $attributes = SerialComparer::getAttributes();
        $values = [];

        foreach ($attributes as $name => $ru_name) {
            $values[$name] = $serial->{$name};
        }

        arsort($values);
        if ($count > 0) {
            $values = array_slice($values, 0, $count);
        }

        $max = [];

        foreach ($values as $attr => $val) {
            $max[] = array('attribute' => $attr, 'value' => $val, 'name_ru' => $attributes[$attr]);
        }

        return $max;
    }
}
