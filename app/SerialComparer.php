<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 18.06.2018
 * Time: 22:46
 */

namespace App;


class SerialComparer
{
    protected $delta = 10;
    protected $delta_step = 1;
    protected $steps = 2;
    protected $attr_count_threshold = 2;

    protected $values = [];
    protected $self_id = -1;

    protected static $attributes = [
        'horror' => 'Ужасы',
        'humor' => 'Юмор',
        'drama' => 'Драма',
        'melodrama' => 'Мелодрама',
        'trash'  => 'Треш',
        'action' => 'Экшн',
        'erotic'  => 'Эротика',
        'beauty'  => 'Красота',
        'concept'  => 'Оригинальность', # концептуальность в прошлом
        'story'  => 'Сюжет',
        'fantastic'  => 'Фантастика',
        'wow'  => 'Вау-эффект',
        'criminal'  => 'Насилие', # криминал в прошлом
    ];

    /**
     * SerialComparer constructor.
     * @param Serial|array $data
     */
    public function __construct($data)
    {
        if ($data instanceof Serial) {
            $this->self_id = $data->id;
            foreach(self::$attributes as $attr_en => $attr_ru) {
                $this->values[$attr_en] = $data->{$attr_en};
            }
        } else {
            $this->values = $data;
        }
    }

    /**
     * @param int $limit
     * @return array
     * Подбирает похожий сериал по параметрам
     */
    public function findSimilar($limit = 3)
    {
        $serials = Serial::all()->shuffle()->toArray();

        $matched = [];
        $attr_deltas = [];
        $delta = $this->delta;
        while (count($matched) < $limit && $delta < 100) {
            foreach ($serials as $serial) {
                $bad_attrs = [];
                for($i=0; $i < $this->steps; $i++) {
                    if ($i == 0) {
                        foreach (self::$attributes as $attr_en => $attr_ru) {
                            if (isset($this->values[$attr_en])) {
                                $current = abs($serial[$attr_en] - $this->values[$attr_en]);
                                $attr_deltas[$serial['id']][$attr_en] = $current;
                                if ($current > $delta) {
                                    $bad_attrs[] = $attr_en;
                                }
                            }
                        }
                    } else {
                        // второй проход, увеличиваем дельту
                        $delta_second = $delta + $this->delta_step;
                        foreach ($bad_attrs as $key => $attr_en) {
                            // проверяем только непрошедшие атрибуты в первом проходе
                            $current = abs($serial[$attr_en] - $this->values[$attr_en]);
                            $attr_deltas[$serial['id']][$attr_en] = $current;
                            if ($current <= $delta) {
                                // удаляем атрибут из непрошедших, если он проходит по новой дельте
                                unset($bad_attrs[$key]);
                            }
                        }
                    }
                }
                if ( (count($this->values) < $this->attr_count_threshold)) {
                    if (count($bad_attrs) == 0 && count($matched) < $limit && $serial['id'] !== $this->self_id) {
                        $serial['delta_sort'] = array_sum($attr_deltas[$serial['id']]);
                        $matched[$serial['id']] = $serial;
                    } else {
                        unset($attr_deltas[$serial['id']]);
                    }
                } else {
                    if ( count($bad_attrs) <= $this->attr_count_threshold
                        && count($matched) < $limit
                        && $serial['id'] !== $this->self_id
                    ) {
                        // dump('add to matched');
                        $serial['delta_sort'] = array_sum($attr_deltas[$serial['id']]);
                        $matched[$serial['id']] = $serial;
                    } else {
                        // dump('skip');
                        unset($attr_deltas[$serial['id']]);
                    }    
                    
                }
                
                // dump('---next---');
            }
            $delta += $this->delta_step;
        }


        uasort($matched, function($a, $b) {
            if ($a['delta_sort'] == $b['delta_sort']) {
                return 0;
            }
            return ($a['delta_sort'] < $b['delta_sort']) ? -1 : 1;
        });

        // dump($matched);

        return $matched;
    }

    public function incDelta($howMuch = 1)
    {
        $this->delta += $howMuch;
    }

    public static function getAttributes()
    {
        return self::$attributes;
    }
}