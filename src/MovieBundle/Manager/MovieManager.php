<?php

declare(strict_types=1);

namespace App\MovieBundle\Manager;

use App\MovieBundle\Entity\Movie;
use App\MovieBundle\Repository\MovieRepository;

/**
 *  Movie Manager
 *
 * @method  MovieRepository getRepo()
 * @method  Movie createClass()
 */
class MovieManager extends MainManager
{
    protected $entityClassName = Movie::class;

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->getRepo()->getAll();
    }

    /**
     * @param int $id
     *
     * @return Movie|null
     */
    public function getById(int $id): ?Movie
    {
        return $this->getRepo()->findOneBy(['movieId' => $id]);
    }

    /**
     * @param int $typeId
     *
     * @return array
     */
    public function getByType(int $typeId): array
    {
        return $this->getRepo()->getByType($typeId);
    }

    /**
     * @param int $id
     *
     * @return Movie|null
     */
    public function findOneById(int $id): ?Movie
    {
        return $this->getRepo()->findOneById($id);
    }

    /**
     * @param array $movieList
     *
     * @return array
     */
    public function getByIds(array $movieList): array
    {
        return $this->getRepo()->getByIds($movieList);
    }

}
