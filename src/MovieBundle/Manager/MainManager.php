<?php

declare(strict_types=1);

namespace App\MovieBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class MainManager
 * @package App\MovieBundle\Manager
 */
abstract class MainManager
{

    /** @var EntityManagerInterface */
    protected $em;

    /** @var EntityRepository */
    protected $repo;

    /** @var string */
    protected $entityClassName;

    /**
     * MainManager constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return EntityRepository
     */
    public function getRepo(): EntityRepository
    {
        if (!$this->repo) {
            $this->repo = $this->em->getRepository($this->entityClassName);
        }

        return $this->repo;
    }

    /**
     * @param $object
     * @param bool $flush
     *
     * @return mixed
     */
    public function save($object, $flush = true)
    {
        $this->em->persist($object);

        if ($flush) {
            $this->em->flush();
        }

        return $object;
    }

    /**
     * @param $object
     * @param bool $flush
     *
     * @return mixed
     */
    public function delete($object, $flush = true)
    {
        $this->em->remove($object);

        if ($flush) {
            $this->em->flush();
        }

        return $object;
    }


    /**
     * Flushes all changes.
     *
     * @return void
     */
    public function flushAll(): void
    {
        $this->em->flush();
    }

}
