<?php

declare(strict_types=1);

namespace App\MovieBundle\Service;

use App\MovieBundle\Entity\Movie;
use App\MovieBundle\Manager\MovieManager;

/**
 * Class MovieService
 * @package App\MovieBundle\Service
 */
class MovieService
{
    /** @var MovieManager */
    protected $movieManager;

    /**
     * ApiService constructor.
     *
     * @param MovieManager $movieManager
     */
    public function __construct(MovieManager $movieManager)
    {
        $this->movieManager = $movieManager;
    }

    /**
     * Get all movies
     *
     * @return array
     */
    public function getAll(): array
    {
        $movies = $this->movieManager->getAll();

        return $this->getDetailMovies($movies);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getById(int $id): array
    {
        $movie = $this->movieManager->getById($id);

        return $this->getDetailMovies([$movie]);
    }

    /**
     * @param array $movies List movies
     *
     * @return array
     */
    public function getDetailMovies(array $movies): array
    {
        $data = [];
        /** @var Movie $movie */
        foreach ($movies as $movie) {
            $movieDetail = [
                'id'          => $movie->getMovieId(),
                'name'        => $movie->getName(),
                'description' => $movie->getDescription(),
                'unit_price'  => number_format($movie->getUnitPrice(), 2),
                'type'        => [
                    'id' => $movie->getFkTypeId()->getMovieTypeId(),
                    'name' => $movie->getFkTypeId()->getName(),
                    'created_at'=> $movie->getFkTypeId()->getCreatedAt()
                ],
                'created_at'  => $movie->getCreatedAt(),
            ];
            $data[] = $movieDetail;
        }

        return $data;
    }

}
