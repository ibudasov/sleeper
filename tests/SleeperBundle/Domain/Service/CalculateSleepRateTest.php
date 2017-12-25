<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\Service\CalculateSleepRate;

class CalculateSleepRateTest extends TestCase
{
    public function testThatServicePerforms(): void
    {
        $sleepMock = \Mockery::mock(Sleep::class);
        $sleepMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn(100);
        $sleepMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn(50);

        $service = new CalculateSleepRate();

        self::assertEquals(50, $service->execute($sleepMock));
    }
}
