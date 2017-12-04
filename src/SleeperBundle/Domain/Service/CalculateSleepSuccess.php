<?php

declare(strict_types=1);

namespace SleeperBundle\Domain\Service;

use SleeperBundle\Domain\Model\Sleep;

class CalculateSleepSuccess implements DomainService
{
    /** @var CalculateSleepRate */
    private $calculateSleepRateService;

    /**
     * @param CalculateSleepRate $calculateSleepRate
     */
    public function __construct(CalculateSleepRate $calculateSleepRate)
    {
        $this->calculateSleepRateService = $calculateSleepRate;
    }

    /**
     * @param Sleep $sleep
     * @return bool
     */
    public function execute(Sleep $sleep): bool
    {
        return ($this->calculateSleepRateService->execute($sleep) >= 50);
    }
}
