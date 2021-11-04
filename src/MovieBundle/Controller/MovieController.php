<?php

declare(strict_types=1);

namespace App\MovieBundle\Controller;

use App\MovieBundle\Exceptions\MovieNotFoundException;
use App\MovieBundle\Exceptions\MovieTypeNotFoundException;
use App\MovieBundle\Service\MovieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MovieController
 * @package App\MovieBundle\Controller
 */
class MovieController extends AbstractController
{
    /** @var MovieService */
    protected $movieService;

    /**
     * MovieController constructor.
     *
     * @param MovieService $movieService
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $movies = $this->movieService->getAll();

        return $this->json($movies, Response::HTTP_OK);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     * @throws MovieNotFoundException
     */
    public function getById(int $id): JsonResponse
    {
        $movie = $this->movieService->getById($id);
        if (!$movie) {
            throw new MovieNotFoundException('Movie not found.');
        }

        return $this->json($movie, Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function getAllTypes(): JsonResponse
    {
        $types = $this->movieService->getAllTypes();

        return $this->json($types, Response::HTTP_OK);
    }

    /**
     * @param int $typeId
     *
     * @return JsonResponse
     * @throws MovieTypeNotFoundException
     */
    public function getByType(int $typeId): JsonResponse
    {
        $types = $this->movieService->getByType($typeId);
        if (!$types) {
            throw new MovieTypeNotFoundException('Movie type not found.');
        }

        return $this->json($types, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws MovieNotFoundException
     */
    public function rentCalculate(Request $request): JsonResponse
    {
        $rentCalculateList = json_decode($request->getContent(), true);
        $calculatedValue = $this->movieService->rentCalculate($rentCalculateList);

        return $this->json($calculatedValue, Response::HTTP_OK);
    }

}
