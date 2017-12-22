<?php

declare(strict_types=1);

namespace SleeperBundle\Domain\Model;

use Assert\Assertion;
use SleeperBundle\Domain\ValueObject\IdentityInterface;

class Sleep implements IdentifiableDomainModelInterface
{
    /** @var IdentityInterface */
    private $id;

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
     * @param IdentityInterface $id
     * @param \DateTime         $startTime
     * @param \DateTime         $endTime
     * @param int               $deepSleepInSeconds
     * @param int               $lightSleepInSeconds
     * @param int               $awakeSeconds
     * @param int               $totalSleepSeconds
     */
    public function __construct(
        IdentityInterface $id,
        \DateTime $startTime,
        \DateTime $endTime,
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

    /** @return IdentityInterface */
    public function getId(): IdentityInterface
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
