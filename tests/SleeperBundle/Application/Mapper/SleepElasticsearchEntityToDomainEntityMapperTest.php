<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Entity\SleepElasticsearchEntity;
use SleeperBundle\Application\Mapper\SleepElasticsearchToDomainEntityMapper;

class SleepElasticsearchEntityToDomainEntityMapperTest extends TestCase
{
    public function testThatElasticsearchEntityIsMappedToDomainEntity(): void
    {
        $mapper = new SleepElasticsearchToDomainEntityMapper();

        $source = Mockery::mock(SleepElasticsearchEntity::class);

        $expectedStarTime = new \DateTime();
        $source->shouldReceive('getStartTime')->once()->andReturn($expectedStarTime);

        $expectedEndTime = new \DateTime();
        $source->shouldReceive('getEndTime')->once()->andReturn($expectedEndTime);

        $expectedDeepSleepSeconds = 1;
        $source->shouldReceive('getDeepSleepSeconds')->once()->andReturn($expectedDeepSleepSeconds);

        $expectedLightSleepSeconds = 2;
        $source->shouldReceive('getLightSleepSeconds')->once()->andReturn($expectedLightSleepSeconds);

        $expectedAwakeSeconds = 3;
        $source->shouldReceive('getAwakeSeconds')->once()->andReturn($expectedAwakeSeconds);

        $expectedTotalSleepSeconds = 22;
        $source->shouldReceive('getTotalSleepSeconds')->once()->andReturn($expectedTotalSleepSeconds);

        $destination = $mapper->map($source);

        self::assertEquals($expectedStarTime, $destination->getStartTime());
        self::assertEquals($expectedEndTime, $destination->getEndTime());
        self::assertEquals($expectedDeepSleepSeconds, $destination->getDeepSleepSeconds());
        self::assertEquals($expectedLightSleepSeconds, $destination->getLightSleepSeconds());
        self::assertEquals($expectedAwakeSeconds, $destination->getAwakeSeconds());
        self::assertEquals($expectedTotalSleepSeconds, $destination->getTotalSleepSeconds());
    }
}
