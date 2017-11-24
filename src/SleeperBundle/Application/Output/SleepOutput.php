<?php declare(strict_types=1);

namespace SleeperBundle\Application\Output;

use JMS\Serializer\Annotation as Serializer;
use SleeperBundle\Domain\Model\Sleep;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class SleepOutput
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("DateTimeImmutable")
     * @Serializer\SerializedName("startTime")
     * @var \DateTimeImmutable
     */
    private $startTime;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("DateTimeImmutable")
     * @Serializer\SerializedName("endTime")
     * @var \DateTimeImmutable
     */
    private $endTime;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("deepSleepSeconds")
     * @var int
     */
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

    /**
     * @return \DateTimeImmutable
     */
    public function getStartTime(): \DateTimeImmutable
    {
        return $this->startTime;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getEndTime(): \DateTimeImmutable
    {
        return $this->endTime;
    }

    /**
     * @return int
     */
    public function getDeepSleepSeconds(): int
    {
        return $this->deepSleepSeconds;
    }

    /**
     * @return int
     */
    public function getLightSleepSeconds(): int
    {
        return $this->lightSleepSeconds;
    }

    /**
     * @return int
     */
    public function getAwakeSeconds(): int
    {
        return $this->awakeSeconds;
    }

    /**
     * @return int
     */
    public function getTotalSleepSeconds(): int
    {
        return $this->totalSleepSeconds;
    }
}
