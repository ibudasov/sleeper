<?php

declare(strict_types=1);

namespace SleeperBundle\Domain\Service;

use SleeperBundle\Domain\Entity\Sleep;

class CalculateSleepSuccess implements DomainServiceInterface
{
    /** @var CalculateSleepRate */
    private $calculateSleepRateService;

    /** @param CalculateSleepRate $calculateSleepRate */
    public function __construct(CalculateSleepRate $calculateSleepRate)
    {
        $this->calculateSleepRateService = $calculateSleepRate;
    }

    /**
     * @param Sleep $sleep
     *
     * @return bool
     */
    public function execute(Sleep $sleep): bool
    {
        return $this->calculateSleepRateService->execute($sleep) >= 50;
    }
}
