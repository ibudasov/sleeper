<?php

declare(strict_types=1);

namespace SleeperBundle\Domain\ValueObject;

class SleepId implements IdentityInterface, ValueObjectInterface
{
    /** @var string */
    private $sleepIdValue;

    /** @param string $sleepIdValue */
    private function __construct(string $sleepIdValue)
    {
        $this->sleepIdValue = $sleepIdValue;
    }

    /** @return IdentityInterface */
    public static function generate(): IdentityInterface
    {
        return self::createFrom(\uniqid());
    }

    /**
     * @param string $sleepIdValue
     *
     * @return IdentityInterface
     */
    public static function createFrom(string $sleepIdValue): IdentityInterface
    {
        return new self($sleepIdValue);
    }

    /** @return string */
    public function __toString(): string
    {
        return $this->sleepIdValue;
    }

    /**
     * @param ValueObjectInterface $that
     *
     * @return bool
     */
    public function isEqualTo(ValueObjectInterface $that): bool
    {
        return $this->sleepIdValue == (string) $that;
    }
}
