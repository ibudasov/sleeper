<?php declare(strict_types=1);

namespace SleeperBundle\Domain\Model;

class Sleep
{
    /** @var \DateTime */
    private $startTime;

    /** @var \DateTime */
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
     * @param \DateTime $startTime
     * @param \DateTime $endTime
     * @param int $deepSleepInSeconds
     * @param int $lightSleepInSeconds
     * @param int $awakeSeconds
     * @param int $totalSleepSeconds
     */
    public function __construct(
        \DateTime $startTime,
        \DateTime $endTime,
        int $deepSleepInSeconds,
        int $lightSleepInSeconds,
        int $awakeSeconds,
        int $totalSleepSeconds
    ) {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->deepSleepSeconds = $deepSleepInSeconds;
        $this->lightSleepSeconds = $lightSleepInSeconds;
        $this->awakeSeconds = $awakeSeconds;
        $this->totalSleepSeconds = $totalSleepSeconds;
    }

    /** @return \DateTime */
    public function getStartTime(): \DateTime
    {
        return $this->startTime;
    }

    /** @return \DateTime */
    public function getEndTime(): \DateTime
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
