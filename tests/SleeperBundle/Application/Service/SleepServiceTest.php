<?php

declare(strict_types=1);

namespace SleeperBundle\Application\Service;

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Output\SleepOutputDTO;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;

class SleepServiceTest extends TestCase
{
    /** @var SleepRepositoryInterface|MockInterface */
    private $repositoryMock;
    /** @var Sleep|MockInterface */
    private $modelMock;
    /** @var SleepService|MockInterface */
    private $applicationService;

    protected function setUp()
    {
        $this->repositoryMock = \Mockery::mock(SleepRepositoryInterface::class);
        $this->modelMock = \Mockery::mock(Sleep::class);

        $this->applicationService = new SleepService($this->repositoryMock);
    }

    public function testThatServiceReturnsMappedOutput(): void
    {
        $startTime = new \DateTime();
        $endTime = new \DateTime();
        $deepSleepSeconds = 1;
        $lightSleepSeconds = 2;
        $awakeSeconds = 3;
        $totalSleepSeconds = 4;

        $this->repositoryMock->shouldReceive('getSleepByDate')->once()->andReturn($this->modelMock);

        $this->modelMock->shouldReceive('getStartTime')->once()->andReturn($startTime);
        $this->modelMock->shouldReceive('getEndTime')->once()->andReturn($endTime);
        $this->modelMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn($deepSleepSeconds);
        $this->modelMock->shouldReceive('getLightSleepSeconds')->once()->andReturn($lightSleepSeconds);
        $this->modelMock->shouldReceive('getAwakeSeconds')->once()->andReturn($awakeSeconds);
        $this->modelMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn($totalSleepSeconds);

        $output = $this->applicationService->getSleepByDate(new \DateTime());

        self::assertInstanceOf(SleepOutputDTO::class, $output);
        self::assertEquals($startTime, $output->getStartTime());
        self::assertEquals($endTime, $output->getEndTime());
        self::assertEquals($deepSleepSeconds, $output->getDeepSleepSeconds());
        self::assertEquals($lightSleepSeconds, $output->getLightSleepSeconds());
        self::assertEquals($awakeSeconds, $output->getAwakeSeconds());
        self::assertEquals($totalSleepSeconds, $output->getTotalSleepSeconds());
    }
}
