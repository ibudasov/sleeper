<?php

declare(strict_types=1);

namespace SleeperBundle\Domain\ValueObject;

class SleepId
{
    /** @var string */
    private $sleepIdValue;

    /**
     * @param string $sleepIdValue
     */
    private function __construct(string $sleepIdValue)
    {
        $this->sleepIdValue = $sleepIdValue;
    }

    /**
     * @return SleepId
     */
    public static function generate(): SleepId
    {
        return self::createFrom(\uniqid());
    }

    /**
     * @param string $sleepIdValue
     * @return SleepId
     */
    public static function createFrom(string $sleepIdValue): SleepId
    {
        return new self($sleepIdValue);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->sleepIdValue;
    }
}