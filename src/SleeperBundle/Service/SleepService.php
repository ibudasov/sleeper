<?php declare(strict_types=1);

namespace SleeperBundle\Service;

use SleeperBundle\Repository\SleepRepositoryInterface;
use SleeperBundle\Model\Sleep;

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
     * 
     * @return SleepResponse
     */
    public function getSleepOnDate(\DateTime $date): Sleep
    {
        return $this->repository->getSleepOnDate($date);
    }
}
