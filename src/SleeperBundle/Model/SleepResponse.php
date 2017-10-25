<?php declare(strict_types=1);

namespace SleeperBundle\Model;

class SleepResponse
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

    /** @param Sleep $sleep */
    public function __construct(Sleep $sleep)
    {
        $this->startTime = $sleep->getStartTime();
        $this->endTime = $sleep->getEndTime();
        $this->deepSleepSeconds = $sleep->getDeepSleepSeconds();
        $this->lightSleepSeconds = $sleep->getLightSleepSeconds();
        $this->awakeSeconds = $sleep->getAwakeSeconds();
        $this->totalSleepSeconds = $sleep->getTotalSleepSeconds();
    }
}
