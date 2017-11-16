<?php declare(strict_types=1);

namespace SleeperBundle\Domain\Service;

use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\Model\Sleep;
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
     * @param \DateTime $date
     *
     * @return Sleep
     * @throws SleepByDateNotFoundException
     */
    public function getSleepByDate(\DateTime $date): Sleep
    {
        return $this->repository->getSleepByDate($date);
    }
}
