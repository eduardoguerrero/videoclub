<?php

declare(strict_types=1);

namespace App\MovieBundle\Manager;

use App\MovieBundle\Entity\MovieType;

/**
 *  Movie Manager
 *
 * @method  MovieTypeRepository getRepo()
 * @method  MovieType createClass()
 */
class MovieTypeManager extends MainManager
{
    protected $entityClassName = MovieType::class;

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->getRepo()->getAll();
    }


}
