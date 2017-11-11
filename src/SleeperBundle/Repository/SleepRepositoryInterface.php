<?php declare(strict_types=1);

namespace SleeperBundle\Repository;

use SleeperBundle\Exception\SleepByDateNotFoundException;
use SleeperBundle\Model\Sleep;

interface SleepRepositoryInterface
{
    /**
     * @param \DateTime $date
     * @return Sleep
     * @throws SleepByDateNotFoundException
     */
    public function getSleepByDate(\DateTime $date): Sleep;
}
