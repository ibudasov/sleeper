<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Controller\Response\SleepResponse;
use SleeperBundle\Mapper\SleepModelToSleepResponseMapper;
use SleeperBundle\Model\Sleep;

class SleepModelToSleepResponseMapperTest extends TestCase
{
    public function testThatSleepModelIsMappedToSleepResponse()
    {
        $mapper = new SleepModelToSleepResponseMapper();

        $startSleep = new \DateTime();
        $endSleep = new \DateTime();
        $deepSleepSeconds = 1;
        $lightSleepSeconds = 2;
        $awakeSeconds = 3;
        $totalSleepSeconds = 4;


        $sleepMock = \Mockery::mock(Sleep::class);
        $sleepMock->shouldReceive('getStartTime')->once()->andReturn($startSleep);
        $sleepMock->shouldReceive('getEndTime')->once()->andReturn($endSleep);
        $sleepMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn($deepSleepSeconds);
        $sleepMock->shouldReceive('getLightSleepSeconds')->once()->andReturn($lightSleepSeconds);
        $sleepMock->shouldReceive('getAwakeSeconds')->once()->andReturn($awakeSeconds);
        $sleepMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn($totalSleepSeconds);

        $result = $mapper::map($sleepMock);

        self::assertInstanceOf(SleepResponse::class, $result);
    }
}