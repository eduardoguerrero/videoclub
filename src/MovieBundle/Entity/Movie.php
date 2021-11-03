<?php

namespace App\MovieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\MovieBundle\Entity\Traits\TimestampableTrait;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\MovieBundle\Repository\MovieRepository")
 */
class Movie
{
    use TimestampableTrait;

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="movie_id", type="integer", nullable=false)
     */
    private $movieId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /** @var float $totalCost
     *
     * @ORM\Column(name="unit_price", type="decimal", nullable=false)
     */
    private $unitPrice;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    /**
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->movieId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Movie
     */
    public function setName(string $name): Movie
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Movie
     */
    public function setDescription(string $description): Movie
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     *
     * @return Movie
     */
    public function setUnitPrice(float $unitPrice): Movie
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool|null $isActive
     *
     * @return Movie
     */
    public function setIsActive(?bool $isActive): Movie
    {
        $this->isActive = $isActive;

        return $this;
    }

}
