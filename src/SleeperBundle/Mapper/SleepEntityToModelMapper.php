<?php declare(strict_types=1);

namespace SleeperBundle\Mapper;

use SleeperBundle\Entity\SleepEntity;
use SleeperBundle\Model\Sleep;

class SleepEntityToModelMapper
{
    /**
     * @param SleepEntity $entity
     * @return Sleep
     */
    public static function map(SleepEntity $entity): Sleep
    {
        return new Sleep(
            $entity->getStartTime(),
            $entity->getEndTime(),
            $entity->getDeepSleepSeconds(),
            $entity->getLightSleepSeconds(),
            $entity->getAwakeSeconds(),
            $entity->getTotalSleepSeconds()
        );
    }
}