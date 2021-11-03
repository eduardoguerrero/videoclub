<?php

declare(strict_types=1);

namespace App\MovieBundle\Repository;

/**
 * Interface MovieRepositoryInterface
 * @package App\MovieBundle\Repository
 */
interface MovieRepositoryInterface
{
    public function getAll(): array;

}
