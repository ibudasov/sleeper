<?php declare(strict_types=1);

namespace SleeperBundle\Repository;

use SleeperBundle\Exception\SleepOnDateNotFoundException;
use SleeperBundle\Model\Sleep;

interface SleepRepositoryInterface
{
    /**
     * @param \DateTime $date
     * @return Sleep
     * @throws SleepOnDateNotFoundException
     */
    public function getSleepOnDate(\DateTime $date): Sleep;
}
