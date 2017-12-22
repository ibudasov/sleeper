<?php

declare(strict_types=1);

namespace SleeperBundle\Domain\Exception;

class SleepByDateNotFoundException extends \LogicException
{
    /**
     * @param \DateTime $startOfPeriod
     * @param \DateTime $endOfPeriod
     */
    public function __construct(\DateTime $startOfPeriod, \DateTime $endOfPeriod)
    {
        $message = \sprintf(
            'No sleep found between "%s" and "%s"',
            $startOfPeriod->format('Y-m-d'),
            $endOfPeriod->format('Y-m-d')
        );

        parent::__construct($message);
    }
}
