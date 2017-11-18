<?php

declare(strict_types=1);

namespace SleeperBundle\Application\Service;

use SleeperBundle\Application\Output\SleepOutput;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;

class SleepService
{
    /** @var SleepRepositoryInterface */
    private $repository;

    public function __construct(SleepRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \DateTime $dateTime
     * @return SleepOutput
     * @throws SleepByDateNotFoundException
     */
    public function getSleepByDate(\DateTime $dateTime): SleepOutput
    {
        $sleepModel = $this->repository->getSleepByDate($dateTime);

        return new SleepOutput($sleepModel);
    }
}
