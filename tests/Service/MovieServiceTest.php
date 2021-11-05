<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\MovieBundle\Manager\MovieManager;
use App\MovieBundle\Manager\MovieTypeManager;
use App\MovieBundle\Service\MovieService;
use PHPUnit\Framework\TestCase;

/**
 * Class MovieServiceTest
 * @package App\Tests\Service
 */
class MovieServiceTest extends TestCase
{
    /** @var MovieManager */
    protected $movieManager;

    /** @var MovieTypeManager */
    protected $movieTypeManager;

    /** @var MovieService */
    protected $movieService;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->movieManager     = $this->createMock(MovieManager::class);
        $this->movieTypeManager = $this->createMock(MovieTypeManager::class);
        $this->movieService = new MovieService($this->movieManager, $this->movieTypeManager);
    }

    /**
     * Run after each test
     * @return void
     */
    protected function tearDown(): void
    {
        $this->movieManager     = null;
        $this->movieTypeManager = null;
    }

    public function testSortByCriterionWithNullSortByCreterio(): void
    {
        $sort = $this->movieService->sortByCriterion($this->getSortByCreterionData(), []);
        $this->assertEqualsCanonicalizing($sort, $this->getSortByCreterionData());
    }

    public function testSortByCriterionWithNullParams(): void
    {
        $sort = $this->movieService->sortByCriterion([], []);
        $this->assertEmpty($sort);
    }

    public function testSortByCriterion(): void
    {
        $sortCriteria = ['age' => 'DESC', 'scoring' => 'DESC'];
        $sort = $this->movieService->sortByCriterion($this->getSortByCreterionData(), $sortCriteria);;
        $this->assertEquals('Mario', $sort[0]['user']);
        $this->assertEquals(45, $sort[0]['age']);
        $this->assertEquals(78, $sort[0]['scoring']);
    }

    /**
     * @return array[]
     */
    private function getSortByCreterionData(): array
    {
        return [
            ['user' => 'Oscar', 'age' => 18, 'scoring' => 40],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => 78],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
        ];
    }

}
