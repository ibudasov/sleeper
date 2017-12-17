<?php declare(strict_types=1);

namespace SleeperBundle\Domain\ValueObject;

interface ValueObjectInterface
{
    /**
     * This method provides an ability to compare two value objects
     *
     * @param ValueObjectInterface $that
     *
     * @return bool
     */
    public function isEqualTo(ValueObjectInterface $that): bool;
}
