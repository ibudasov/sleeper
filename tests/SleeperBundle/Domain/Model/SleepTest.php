<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Domain\Model\Sleep;
use SleeperBundle\Domain\ValueObject\SleepId;

class SleepTest extends TestCase
{
    public function testThatModelCanBeCreatedWithCorrectInput(): void
    {
        $sleepId = SleepId::generate();
        $expectedStartTime = new \DateTime();
        $expectedEndTime = new \DateTime();
        $expectedDeepSleep = 90;
        $expectedLightSleep = 45;
        $expectedAwake = 234;
        $expectedTotalSleep = 234;

        $sleep = new Sleep(
            $sleepId,
            $expectedStartTime,
            $expectedEndTime,
            $expectedDeepSleep,
            $expectedLightSleep,
            $expectedAwake,
            $expectedTotalSleep
        );

        self::assertEquals($sleepId, $sleep->getId());
        self::assertEquals($expectedStartTime, $sleep->getStartTime());
        self::assertEquals($expectedEndTime, $sleep->getEndTime());
        self::assertEquals($expectedDeepSleep, $sleep->getDeepSleepSeconds());
        self::assertEquals($expectedLightSleep, $sleep->getLightSleepSeconds());
        self::assertEquals($expectedAwake, $sleep->getAwakeSeconds());
        self::assertEquals($expectedTotalSleep, $sleep->getTotalSleepSeconds());
    }
}
