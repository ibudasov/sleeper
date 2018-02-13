<?php

declare(strict_types=1);

namespace SleeperBundle\Application\Entity;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class SleepElasticsearchEntity
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $id;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("DateTime")
     *
     * @var \DateTime
     */
    private $startTime;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("DateTime")
     *
     * @var \DateTime
     */
    private $endTime;

    /**
     * @var int
     */
    private $deepSleepSeconds;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $lightSleepSeconds;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $awakeSeconds;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $totalSleepSeconds;

    /**
     * SleepElasticsearchEntity constructor.
     *
     * @param string    $id
     * @param \DateTime $startTime
     * @param \DateTime $endTime
     * @param int       $deepSleepSeconds
     * @param int       $lightSleepSeconds
     * @param int       $awakeSeconds
     * @param int       $totalSleepSeconds
     */
    public function __construct(
        string $id,
        \DateTime $startTime,
        \DateTime $endTime,
        int $lightSleepSeconds,
        int $deepSleepSeconds,
        int $awakeSeconds,
        int $totalSleepSeconds
    ) {
        $this->id = $id;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->deepSleepSeconds = $deepSleepSeconds;
        $this->lightSleepSeconds = $lightSleepSeconds;
        $this->awakeSeconds = $awakeSeconds;
        $this->totalSleepSeconds = $totalSleepSeconds;
    }

    /** @return string */
    public function getId(): string
    {
        return $this->id;
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
