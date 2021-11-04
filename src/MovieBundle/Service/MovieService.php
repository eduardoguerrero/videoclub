<?php

declare(strict_types=1);

namespace App\MovieBundle\Service;

use App\MovieBundle\Entity\Movie;
use App\MovieBundle\Entity\MovieType;
use App\MovieBundle\Exceptions\MovieNotFoundException;
use App\MovieBundle\Manager\MovieManager;
use App\MovieBundle\Manager\MovieTypeManager;
use App\MovieBundle\Utils\RentCalculateContext;

/**
 * Class MovieService
 * @package App\MovieBundle\Service
 */
class MovieService
{
    /** @var MovieManager */
    protected $movieManager;

    /** @var MovieTypeManager */
    protected $movieTypeManager;

    /**
     * MovieService constructor.
     *
     * @param MovieManager $movieManager
     * @param MovieTypeManager $movieTypeManager
     */
    public function __construct(MovieManager $movieManager, MovieTypeManager $movieTypeManager)
    {
        $this->movieManager     = $movieManager;
        $this->movieTypeManager = $movieTypeManager;
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
     * @return array
     */
    public function getAllTypes(): array
    {
        $types = $this->movieTypeManager->getAll();

        return $this->getDetailType($types);
    }

    /**
     * @param $typeId
     *
     * @return array
     */
    public function getByType($typeId): array
    {
        return $this->movieManager->getByType($typeId);
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
                    'id'         => $movie->getFkTypeId()->getMovieTypeId(),
                    'name'       => $movie->getFkTypeId()->getName(),
                    'created_at' => $movie->getFkTypeId()->getCreatedAt(),
                ],
                'created_at'  => $movie->getCreatedAt(),
            ];
            $data[] = $movieDetail;
        }

        return $data;
    }

    /**
     * @param array $types
     *
     * @return array
     */
    public function getDetailType(array $types): array
    {
        $data = [];
        /** @var MovieType $movie */
        foreach ($types as $type) {
            $typeDetail = [
                'id'         => $type->getMovieTypeId(),
                'name'       => $type->getName(),
                'created_at' => $type->getCreatedAt(),
            ];
            $data[] = $typeDetail;
        }

        return $data;
    }

    /**
     * @param array $rentCalculateList
     *
     * @return array
     */
    public function rentCalculate(array $rentCalculateList): array
    {
        // Get movie ids
        $movieList = [];
        foreach ($rentCalculateList as $rentCalculate) {
            $movieList[] = $rentCalculate['movie_id'];
        }
        // Calculate costs
        $response = [];
        $movies = $this->movieManager->getByIds($movieList);
        foreach ($movies as $movie) {
            $strategyContext = new RentCalculateContext($movie['code']);

            $currentMovie = array_filter($rentCalculateList, static function($item) use ($movie) {
                return ($item['movie_id'] === $movie['movieId']);
            });

            $item = [
                'name' => $movie['name'],
                'type' => $movie['type'],
                'costs' => $strategyContext->RentCalculate(end($currentMovie), $movie),
            ];
            $response[] = $item;
        }

        return $response;
    }
}
