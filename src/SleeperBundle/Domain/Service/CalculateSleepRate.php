<?php

declare(strict_types=1);

namespace SleeperBundle\Domain\Service;

use SleeperBundle\Domain\Model\Sleep;

class CalculateSleepRate implements DomainService
{
    /**
     * @param Sleep $sleep
     * @return float
     */
    public function execute(Sleep $sleep): float
    {
        return $sleep->getDeepSleepSeconds() / $sleep->getTotalSleepSeconds() * 100;
    }
}

