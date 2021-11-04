<?php

declare(strict_types=1);

namespace App\MovieBundle\Repository;

use App\MovieBundle\Entity\Movie;
use App\MovieBundle\Entity\MovieType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class MovieRepository extends ServiceEntityRepository implements MovieRepositoryInterface
{

    /**
     * MovieRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * Get all movies
     *
     * @return array
     */
    public function getAll(): array
    {
        $qb = $this->createQueryBuilder('m')->getQuery();

        return $qb->getResult();
    }

    /**
     * Get movie by type
     *
     * @param int $typeId
     *
     * @return array
     */
    public function getByType(int $typeId): array
    {
        $qb = $this->createQueryBuilder('m');
        $qb
            ->select(
                [
                    'm.movieId',
                    'm.name',
                    'm.description',
                    'm.unitPrice',
                    'm.isActive',
                    'm.createdAt',
                    't.name as type',
                ]
            )
            ->innerJoin(
                MovieType::class,
                't',
                'WITH',
                't.movieTypeId = m.fkTypeId'
            )
            ->where('m.fkTypeId= :fkTypeId')
            ->setParameter('fkTypeId', $typeId);

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @param int $id
     *
     * @return Movie|null
     */
    public function findOneById(int $id)
    {
        return $this->findOneBy(['movieId' => $id]);
    }

}
