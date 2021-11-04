<?php

namespace App\MovieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\MovieBundle\Entity\Traits\TimestampableTrait;

/**
 * MovieType
 *
 * @ORM\Table(name="movie_type")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\MovieBundle\Repository\MovieTypeRepository")
 */
class MovieType
{
    use TimestampableTrait;

    public const TYPE_NEW = 'new';
    public const TYPE_OLD = 'old';
    public const TYPE_NORMAL = 'normal';

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="movie_type_id", type="integer", nullable=false)
     */
    private $movieTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=45, nullable=false)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="days", type="smallint", nullable=false)
     */
    private $days;

    /**
     * @return int
     */
    public function getMovieTypeId(): int
    {
        return $this->movieTypeId;
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
     * @return MovieType
     */
    public function setName(string $name): MovieType
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return MovieType
     */
    public function setCode(string $code): MovieType
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return int
     */
    public function getDays(): int
    {
        return $this->days;
    }

    /**
     * @param int $days
     *
     * @return MovieType
     */
    public function setDays(int $days): MovieType
    {
        $this->days = $days;

        return $this;
    }

}
