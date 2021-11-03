<?php

declare(strict_types=1);

namespace App\MovieBundle\Repository;

/**
 * Interface MovieTypeRepositoryInterface
 * @package App\MovieBundle\Repository
 */
interface MovieTypeRepositoryInterface
{
    public function getAll(): array;

}
