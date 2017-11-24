<?php declare(strict_types=1);

namespace SleeperBundle\Domain\Repository;

use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\Model\Sleep;

interface SleepRepositoryInterface
{
    /**
     * @param \DateTimeImmutable $date
     * @return Sleep
     * @throws SleepByDateNotFoundException
     */
    public function getSleepByDate(\DateTimeImmutable $date): Sleep;
}
