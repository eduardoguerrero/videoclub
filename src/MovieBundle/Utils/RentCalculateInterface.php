<?php

namespace App\MovieBundle\Utils;

/**
 * Interface RentCalculateInterface
 * @package App\MovieBundle\Utils
 */
interface RentCalculateInterface
{
    public function calculate(string $code): float;
}
