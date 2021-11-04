<?php

declare(strict_types=1);

namespace App\MovieBundle\Utils;

use App\MovieBundle\Entity\Movie;
use DateInterval;

/**
 * Class AbstractRentCalculate
 * @package App\MovieBundle\Utils
 */
abstract class AbstractRentCalculate implements RentCalculateInterface
{

    /**
     * @param string $starDate
     * @param string $endDate
     *
     * @return DateInterval|false
     */
    public function getDaysDiff(string $starDate, string $endDate)
    {
        $starDate = date_create($starDate);
        $endDate  = date_create($endDate);

        return date_diff($starDate, $endDate);
    }

    /**
     * @param Movie $movie
     * @param int $calculatedDays
     *
     * @return float
     */
    public function getExtraCost(Movie $movie, int $calculatedDays): float
    {
        $extraCost = 0.0;
        if ($calculatedDays > $movie->getFkTypeId()->getDays()) {
            $extraDays = $calculatedDays - $movie->getFkTypeId()->getDays();
            $extraCost = $extraDays * $movie->getUnitPrice();
        }

        return $extraCost;
    }

}
