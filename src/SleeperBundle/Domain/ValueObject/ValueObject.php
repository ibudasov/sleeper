<?php declare(strict_types=1);

namespace SleeperBundle\Domain\ValueObject;

interface ValueObject
{
    /**
     * This method provides an ability to compare two value objects
     *
     * @param ValueObject $that
     *
     * @return bool
     */
    public function isEqualTo(ValueObject $that): bool;
}
