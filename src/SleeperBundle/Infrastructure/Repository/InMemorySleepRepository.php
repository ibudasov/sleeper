<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure\Repository;

use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\Model\Sleep;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;

class InMemorySleepRepository implements SleepRepositoryInterface
{
    /** @var Sleep[] */
    private $sleeps = [];

    /** @param InMemorySleepStub $stubs */
    public function __construct(InMemorySleepStub $stubs)
    {
        $this->sleeps = $stubs->getStubs();
    }

    /** @param Sleep $sleep */
    public function add(Sleep $sleep): void
    {
        array_push($this->sleeps, $sleep);
    }

    /**
     * @param \DateTime $date
     *
     * @return Sleep
     * @throws SleepByDateNotFoundException
     */
    public function getSleepByDate(\DateTime $date): Sleep
    {
        $startOfPeriod = clone($date);
        $startOfPeriod->modify('-1 day');
        $endOfPeriod = clone($date);
        $endOfPeriod->modify('+1 day');

        $result = null;
        foreach ($this->sleeps as $sleep) {
            if ($startOfPeriod <= $sleep->getStartTime() && $sleep->getStartTime() <= $endOfPeriod) {
                $result = $sleep;
            }
        }

        if (empty($result)) {
            throw new SleepByDateNotFoundException($startOfPeriod, $endOfPeriod);
        }

        return $result;
    }
}
