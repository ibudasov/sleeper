<?php declare(strict_types=1);

namespace SleeperBundle\Domain\Model;

use Assert\Assertion;
use SleeperBundle\Domain\ValueObject\SleepId;

class Sleep
{
    /** @var SleepId */
    private $id;
    /** @var \DateTimeImmutable */
    private $startTime;

    /** @var \DateTimeImmutable */
    private $endTime;

    /** @var int */
    private $deepSleepSeconds;

    /** @var int */
    private $lightSleepSeconds;

    /** @var int */
    private $awakeSeconds;

    /** @var int */
    private $totalSleepSeconds;

    /**
     * @param SleepId $id
     * @param \DateTimeImmutable $startTime
     * @param \DateTimeImmutable $endTime
     * @param int $deepSleepInSeconds
     * @param int $lightSleepInSeconds
     * @param int $awakeSeconds
     * @param int $totalSleepSeconds
     */
    public function __construct(
        SleepId $id,
        \DateTimeImmutable $startTime,
        \DateTimeImmutable $endTime,
        int $deepSleepInSeconds,
        int $lightSleepInSeconds,
        int $awakeSeconds,
        int $totalSleepSeconds
    ) {
        Assertion::greaterThan($endTime, $startTime);
        Assertion::greaterThan($totalSleepSeconds, $deepSleepInSeconds);
        Assertion::greaterThan($totalSleepSeconds, $lightSleepInSeconds);

        $this->id = $id;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->deepSleepSeconds = $deepSleepInSeconds;
        $this->lightSleepSeconds = $lightSleepInSeconds;
        $this->awakeSeconds = $awakeSeconds;
        $this->totalSleepSeconds = $totalSleepSeconds;
    }

    /** @return \DateTimeImmutable */
    public function getStartTime(): \DateTimeImmutable
    {
        return $this->startTime;
    }

    /** @return \DateTimeImmutable */
    public function getEndTime(): \DateTimeImmutable
    {
        return $this->endTime;
    }

    /** @return int */
    public function getDeepSleepSeconds(): int
    {
        return $this->deepSleepSeconds;
    }

    /** @return int */
    public function getLightSleepSeconds(): int
    {
        return $this->lightSleepSeconds;
    }

    /** @return int */
    public function getAwakeSeconds(): int
    {
        return $this->awakeSeconds;
    }

    /** @return int */
    public function getTotalSleepSeconds(): int
    {
        return $this->totalSleepSeconds;
    }
}
