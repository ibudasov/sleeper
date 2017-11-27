<?php declare(strict_types=1);

namespace SleeperBundle\Domain\Model;

use SleeperBundle\Domain\ValueObject\Identity;

/**
 * DomainEntity suppose to be unique entity, because otherwise it's value object
 * ​No matter how many changes happened to entity - identity still the same
 * It couples the design of the database to the design of the object system
 */
interface IdentifiableDomainEntity
{
    /** @return Identity */
    public function getId(): Identity;
}