<?php

declare(strict_types=1);

namespace SleeperBundle\Domain\Repository;

use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;

/**
 * Repository's interface belongs to domain, but repository's implementation belongs to infrastructure.
 * It's been made like this for sake of Dependency Inversion: in the rest of codebase we never
 * mention implementation, but mention the interface instead.
 */
interface SleepRepositoryInterface
{
    /**
     * @param \DateTime $date
     *
     * @return Sleep
     *
     * @throws SleepByDateNotFoundException
     */
    public function getSleepByDate(\DateTime $date): Sleep;
}
