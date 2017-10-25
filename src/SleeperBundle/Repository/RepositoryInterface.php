<?php declare(strict_types=1);

namespace SleeperBundle\Repository;

use SleeperBundle\Exceptions\SleepOnDateNotFoundException;
use SleeperBundle\Model\Sleep;

interface RepositoryInterface
{
    /**
     * @param \DateTime $date
     * @return Sleep
     * @throws SleepOnDateNotFoundException
     */
    public function getSleepOnDate(\DateTime $date): Sleep;
}
