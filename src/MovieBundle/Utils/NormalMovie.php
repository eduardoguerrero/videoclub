<?php

declare(strict_types=1);

namespace App\MovieBundle\Utils;

/**
 * Class NormalMovie
 * @package App\MovieBundle\Utils
 */
class NormalMovie implements RentCalculateInterface
{

    /**
     * @param string $code
     *
     * @return float
     */
    public function calculate(string $code): float
    {
        return 15.00;
    }
}
