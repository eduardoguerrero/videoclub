<?php

declare(strict_types=1);

namespace App\MovieBundle\Utils;

/**
 * Class OldMovie
 * @package App\MovieBundle\Utils
 */
class OldMovie implements RentCalculateInterface
{

    /**
     * @param string $code
     *
     * @return float
     */
    public function calculate(string $code): float
    {
        return 11.00;
    }
}
