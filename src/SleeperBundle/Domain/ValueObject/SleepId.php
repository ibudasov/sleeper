<?php

declare(strict_types=1);

namespace SleeperBundle\Domain\ValueObject;

class SleepId implements Identity, ValueObject
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
     * @return Identity
     */
    public static function generate(): Identity
    {
        return self::createFrom(\uniqid());
    }

    /**
     * @param string $sleepIdValue
     *
     * @return Identity
     */
    public static function createFrom(string $sleepIdValue): Identity
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

    /**
     * @param ValueObject $that
     *
     * @return bool
     */
    public function isEqualTo(ValueObject $that): bool
    {
        return $this->sleepIdValue == (string) $that;
    }
}
