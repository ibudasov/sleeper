<?php

declare(strict_types=1);

namespace SleeperBundle\Mapper;

use SleeperBundle\Controller\Response\SleepResponse;
use SleeperBundle\Model\Sleep;

class SleepModelToSleepResponseMapper
{
    /**
     * @param Sleep $sleep
     * @return SleepResponse
     */
    public static function map(Sleep $sleep): SleepResponse
    {
        return new SleepResponse($sleep);
    }
}