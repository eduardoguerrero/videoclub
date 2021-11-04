<?php

declare(strict_types=1);

namespace App\MovieBundle\Utils;

use App\MovieBundle\Entity\Movie;

/**
 * Class NewMovie
 * @package App\MovieBundle\Utils
 */
class NewMovie extends AbstractRentCalculate
{

    /**
     * @param array $rentCalculate
     * @param Movie $movie
     *
     * @return float
     */
    public function calculate(array $rentCalculate, Movie $movie): float
    {
        $calculatedDays = $this->getDaysDiff($rentCalculate['start_date'], $rentCalculate['end_date'])->d;

        $price = $movie->getUnitPrice() * $calculatedDays;

        return $price;
    }
}
