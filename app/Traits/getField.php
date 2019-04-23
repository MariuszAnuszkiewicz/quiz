<?php

namespace App\Traits;

trait getField
{
    public function getField($array)
    {
        $arr = [];
        foreach ($array as $key => $value) {
            $arr['field'] = $array[$key][0];
            return $arr;
        }
    }
}