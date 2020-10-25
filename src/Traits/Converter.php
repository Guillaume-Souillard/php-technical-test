<?php


namespace App\Traits;


trait Converter
{
    /**
     * @param int $value
     * @return float|int
     */
    public function meterToKilometer(int $value): float {
        return round($value / 1000, 3);
    }

    /**
     * @param int $value
     * @return float
     */
    public function secondToMinute(int $value): float {
        return round($value / 60, 2);
    }

    /**
     * @param $value
     * @return float
     */
    public function meterPerSecondIntoKilometerPerHour(float $value): float {
        return round($value * 3.5, 2);
    }

    /**
     * @param float $value
     * @return float
     */
    public function secondPerMeterIntoMinutePerKilometer(float $value): int {
        $average = $value * 16.667;

        return (int)$average * 60;
    }
}