<?php

declare(strict_types=1);

namespace App\MovieBundle\Repository;

use App\MovieBundle\Entity\MovieType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MovieType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieType[]    findAll()
 * @method MovieType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class MovieTypeRepository extends ServiceEntityRepository implements MovieTypeRepositoryInterface
{

    /**
     * MovieTypeRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieType::class);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $qb = $this->createQueryBuilder('t')->getQuery();

        return $qb->getResult();
    }

}
