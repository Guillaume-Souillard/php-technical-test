<?php


namespace App\Traits;


trait Converter
{
    /**
     * @param int $value
     * @return float|int
     */
    public function metterToKilometter(int $value): float {
        return round($value / 1000, 3);
    }

    /**
     * @param int $value
     * @return float
     */
    public function secondToMinute(int $value): float {
        return round($value / 60, 2);
    }
}