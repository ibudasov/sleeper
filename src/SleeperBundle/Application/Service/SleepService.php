<?php

declare(strict_types=1);

namespace SleeperBundle\Application\Service;

use SleeperBundle\Application\Output\SleepOutputDTO;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;

class SleepService
{
    /** @var SleepRepositoryInterface */
    private $repository;

    /** @param SleepRepositoryInterface $repository */
    public function __construct(SleepRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \DateTime $dateTime
     *
     * @return SleepOutputDTO
     * @throws SleepByDateNotFoundException
     */
    public function getSleepByDate(\DateTime $dateTime): SleepOutputDTO
    {
        $sleepModel = $this->repository->getSleepByDate($dateTime);

        return new SleepOutputDTO($sleepModel);
    }
}
