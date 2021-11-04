<?php

declare(strict_types=1);

namespace App\MovieBundle\Utils;

/**
 * Class NewMovie
 * @package App\MovieBundle\Utils
 */
class NewMovie extends AbstractRentCalculate
{

    /**
     * @param array $rentCalculate
     * @param array $movie
     *
     * @return array
     */
    public function calculate(array $rentCalculate, array $movie): array
    {
        $calculatedDays = $this->getDaysDiff($rentCalculate['start_date'], $rentCalculate['end_date'])->d;

        return $this->getCosts($movie, $calculatedDays);
    }
}
