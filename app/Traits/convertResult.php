<?php

namespace App\Traits;

trait convertResult {

    public function ConvertResultToPercent($answers, $value)
    {
        if (!is_null($answers) && !is_null($value)) {
            @$output = $answers / $value;
        }
        return $convert = ($value == 0) ? null : intval(100 / $output);
    }
}