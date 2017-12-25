<?php

declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\Service\CalculateSleepRate;
use SleeperBundle\Domain\Service\CalculateSleepSuccess;

class CalculateSleepSuccessTest extends TestCase
{
    /** @var Sleep|MockInterface */
    private $sleepMock;
    /** @var CalculateSleepRate|MockInterface */
    private $calculateSleepRateServiceMock;

    protected function setUp(): void
    {
        $this->sleepMock = \Mockery::mock(Sleep::class);
        $this->calculateSleepRateServiceMock = \Mockery::mock(CalculateSleepRate::class);
    }

    public function testThatSleepIsConsideredSuccessfulIfSleepRateIsMoreThan50(): void
    {
        $this->calculateSleepRateServiceMock
            ->shouldReceive('execute')
            ->once()
            ->with($this->sleepMock)
            ->andReturn(50);

        $service = new CalculateSleepSuccess($this->calculateSleepRateServiceMock);

        self::assertTrue($service->execute($this->sleepMock));
    }

    public function testThatSleepIsConsideredNotSuccessfulWhenSleepRateIsBelow50(): void
    {
        $this->calculateSleepRateServiceMock
            ->shouldReceive('execute')
            ->once()
            ->with($this->sleepMock)
            ->andReturn(49);

        $service = new CalculateSleepSuccess($this->calculateSleepRateServiceMock);

        self::assertFalse($service->execute($this->sleepMock));
    }
}
