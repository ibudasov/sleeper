<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Entity\SleepDoctrineEntity;

class SleepEntityTest extends TestCase
{
    public function testThatEntityCanBeCreatedWithValidValues(): void
    {
        $id = \uniqid();
        $startTime = new \DateTime();
        $endTime = new \DateTime();
        $lightSleepSeconds = 1;
        $deepSleepSeconds = 2;
        $awakeSeconds = 3;
        $totalSleepSeconds = 4;

        $sleepEntity = new SleepDoctrineEntity();

        $sleepEntity->setId($id);
        $sleepEntity->setStartTime($startTime);
        $sleepEntity->setEndTime($endTime);
        $sleepEntity->setLightSleepSeconds($lightSleepSeconds);
        $sleepEntity->setDeepSleepSeconds($deepSleepSeconds);
        $sleepEntity->setAwakeSeconds($awakeSeconds);
        $sleepEntity->setTotalSleepSeconds($totalSleepSeconds);

        self::assertEquals($id, $sleepEntity->getId());
        self::assertEquals($startTime, $sleepEntity->getStartTime());
        self::assertEquals($endTime, $sleepEntity->getEndTime());
        self::assertEquals($lightSleepSeconds, $sleepEntity->getLightSleepSeconds());
        self::assertEquals($deepSleepSeconds, $sleepEntity->getDeepSleepSeconds());
        self::assertEquals($awakeSeconds, $sleepEntity->getAwakeSeconds());
        self::assertEquals($totalSleepSeconds, $sleepEntity->getTotalSleepSeconds());
    }
}
