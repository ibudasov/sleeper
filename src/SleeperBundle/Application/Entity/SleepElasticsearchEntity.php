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

    /** @return string */
    public function getId(): string
    {
        return $this->id;
    }

    /** @param string $id */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /** @return \DateTime */
    public function getStartTime(): \DateTime
    {
        return $this->startTime;
    }

    /** @param \DateTime $startTime */
    public function setStartTime(\DateTime $startTime): void
    {
        $this->startTime = $startTime;
    }

    /** @return \DateTime */
    public function getEndTime(): \DateTime
    {
        return $this->endTime;
    }

    /** @param \DateTime $endTime */
    public function setEndTime(\DateTime $endTime): void
    {
        $this->endTime = $endTime;
    }

    /** @return int */
    public function getDeepSleepSeconds(): int
    {
        return $this->deepSleepSeconds;
    }

    /** @param int $deepSleepSeconds */
    public function setDeepSleepSeconds(int $deepSleepSeconds): void
    {
        $this->deepSleepSeconds = $deepSleepSeconds;
    }

    /** @return int */
    public function getLightSleepSeconds(): int
    {
        return $this->lightSleepSeconds;
    }

    /** @param int $lightSleepSeconds */
    public function setLightSleepSeconds(int $lightSleepSeconds): void
    {
        $this->lightSleepSeconds = $lightSleepSeconds;
    }

    /** @return int */
    public function getAwakeSeconds(): int
    {
        return $this->awakeSeconds;
    }

    /** @param int $awakeSeconds */
    public function setAwakeSeconds(int $awakeSeconds): void
    {
        $this->awakeSeconds = $awakeSeconds;
    }

    /** @return int */
    public function getTotalSleepSeconds(): int
    {
        return $this->totalSleepSeconds;
    }

    /** @param int $totalSleepSeconds */
    public function setTotalSleepSeconds(int $totalSleepSeconds): void
    {
        $this->totalSleepSeconds = $totalSleepSeconds;
    }
}
