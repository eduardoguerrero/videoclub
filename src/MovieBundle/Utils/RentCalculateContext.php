<?php

declare(strict_types=1);

namespace App\MovieBundle\Utils;

use App\MovieBundle\Entity\Movie;
use App\MovieBundle\Entity\MovieType;

/**
 * Class RentCalculateContext
 * @package App\MovieBundle\Utils
 */
class RentCalculateContext
{

    /** @var NewMovie|NormalMovie|OldMovie|null */
    private $strategy;

    /**
     * RentCalculateContext constructor.
     *
     * @param string $movieTypeCode
     */
    public function __construct(string $movieTypeCode)
    {
        switch ($movieTypeCode) {
            case MovieType::TYPE_NEW:
                $this->strategy = new NewMovie();
                break;
            case  MovieType::TYPE_NORMAL:
                $this->strategy = new NormalMovie();
                break;
            case  MovieType::TYPE_OLD:
                $this->strategy = new OldMovie();
                break;
        }
    }

    /**
     * @param array $rentCalculate
     * @param Movie $movie
     *
     * @return float
     */
    public function RentCalculate(array $rentCalculate, Movie $movie): float
    {
        return $this->strategy->calculate($rentCalculate, $movie);
    }

}
