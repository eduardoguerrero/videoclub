<?php

declare(strict_types=1);

namespace App\MovieBundle\Utils;

use App\MovieBundle\Entity\Movie;
use App\MovieBundle\Entity\MovieType;
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
     * @param array $movie
     * @param int $calculatedDays
     *
     * @return array
     */
    public function getCosts(array $movie, int $calculatedDays): array
    {
        $extraCost = 0.0;
        if ($movie['type'] === MovieType::TYPE_NEW) {
            return [
                'price'      => (float)$movie['unitPrice'] * $calculatedDays,
                'extra_cost' => $extraCost,
                'total'      => (float)$movie['unitPrice'] * $calculatedDays,
            ];
        }

        if ($calculatedDays > $movie['days']) {
            $extraDays = $calculatedDays - $movie['days'];
            $extraCost = $extraDays * $movie['unitPrice'];
        }

        return [
            'price'      => (float)$movie['unitPrice'],
            'extra_cost' => $extraCost,
            'total'      => (float)$movie['unitPrice'] + $extraCost,
        ];
    }

}
