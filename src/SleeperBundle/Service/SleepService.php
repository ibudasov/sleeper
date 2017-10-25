<?php declare(strict_types=1);

namespace SleeperBundle\Service;

use SleeperBundle\Model\SleepResponse;
use SleeperBundle\Repository\SleepRepositoryInterface;

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
     * @param \DateTime $date
     * @return SleepResponse
     */
    public function getSleepOnDate(\DateTime $date): SleepResponse
    {
        $sleepModel = $this->repository->getSleepOnDate($date);

        return new SleepResponse($sleepModel);
    }
}
