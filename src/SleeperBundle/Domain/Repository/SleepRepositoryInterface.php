<?php declare(strict_types=1);

namespace SleeperBundle\Domain\Repository;

use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\Model\Sleep;

interface SleepRepositoryInterface
{
    /**
     * @param \DateTime $date
     * @return Sleep
     * @throws SleepByDateNotFoundException
     */
    public function getSleepByDate(\DateTime $date): Sleep;
}
