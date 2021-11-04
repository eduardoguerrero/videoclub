<?php

namespace App\MovieBundle\Utils;

use App\MovieBundle\Entity\Movie;

/**
 * Interface RentCalculateInterface
 * @package App\MovieBundle\Utils
 */
interface RentCalculateInterface
{
    public function calculate(array $rentCalculate, Movie $movie): float;
}
