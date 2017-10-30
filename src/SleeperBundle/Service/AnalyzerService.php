<?php declare(strict_types=1);

namespace SleeperBundle\Service;

use SleeperBundle\Model\Sleep;

class AnalyzerService
{
    /**
     * @param Sleep $sleep
     * @return float
     */
    public function getSuccessResultInPercent(Sleep $sleep): float
    {
        return $sleep->getDeepSleepSeconds() / $sleep->getTotalSleepSeconds() * 100;
    }

    /**
     * @param Sleep $sleep
     * @return bool
     */
    public function isSuccessful(Sleep $sleep): bool
    {
        return ($this->getSuccessResultInPercent($sleep) > 50);
    }
}
