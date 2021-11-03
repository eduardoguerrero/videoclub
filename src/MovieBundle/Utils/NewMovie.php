<?php

declare(strict_types=1);

namespace App\MovieBundle\Utils;

/**
 * Class NewMovie
 * @package App\MovieBundle\Utils
 */
class NewMovie implements RentCalculateInterface
{

    /**
     * @param string $code
     *
     * @return float
     */
    public function calculate(string $code): float
    {
        return 10.3;
    }
}
