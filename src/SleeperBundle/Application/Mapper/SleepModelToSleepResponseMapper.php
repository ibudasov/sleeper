<?php

declare(strict_types=1);

namespace SleeperBundle\Application\Mapper;

use SleeperBundle\Application\Output\SleepOutput;
use SleeperBundle\Domain\Model\Sleep;

class SleepModelToSleepResponseMapper
{
    /**
     * @param Sleep $sleep
     * @return SleepOutput
     */
    public static function map(Sleep $sleep): SleepOutput
    {
        return new SleepOutput($sleep);
    }
}