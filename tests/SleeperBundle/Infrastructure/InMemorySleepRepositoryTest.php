<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\ValueObject\SleepId;
use SleeperBundle\Infrastructure\Repository\InMemorySleepRepository;
use SleeperBundle\Infrastructure\Repository\InMemorySleepStub;

class InMemorySleepRepositoryTest extends TestCase
{
    /** @var InMemorySleepRepository */
    protected $repository;

    protected function setUp()
    {
        $stubMock = \Mockery::mock(InMemorySleepStub::class);
        $stubMock->shouldReceive('getStubs')
            ->once()
            ->andReturn([]);
        $this->repository = new InMemorySleepRepository($stubMock);
    }

    public function testThatMultipleSleepsCanBeAddedAndNeedOneCanBeRetrieved(): void
    {
        $sleep1 = new Sleep(
            SleepId::createFrom('sleep-1'),
            new \DateTime('-5 days'),
            new \DateTime('-4 days'),
            2,
            3,
            4,
            5
        );
        $sleep2 = new Sleep(
            SleepId::createFrom('sleep-2'),
            new \DateTime('-3 days'),
            new \DateTime('-2 days'),
            3,
            4,
            5,
            6
        );
        $sleep3 = new Sleep(
            SleepId::createFrom('sleep-3'),
            new \DateTime('-1 days'),
            new \DateTime('today'),
            4,
            5,
            6,
            7
        );
        $this->repository->add($sleep1);
        $this->repository->add($sleep2);
        $this->repository->add($sleep3);

        $retrievedSleep = $this->repository->getSleepByDate(new \DateTime('-3 days'));

        self::assertGreaterThan(new \DateTime('-4 days'), $retrievedSleep->getStartTime(), (string) $retrievedSleep->getId());
        self::assertLessThan(new \DateTime('-2 days'), $retrievedSleep->getStartTime());
    }

    public function testThatExceptionIsThrownWhenSleepNotFound(): void
    {
        $this->expectException(SleepByDateNotFoundException::class);

        $this->repository->getSleepByDate(new \DateTime('-3 days'));
    }
}
