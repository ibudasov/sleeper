<?php declare(strict_types=1);

namespace SleeperBundle\Application\Mapper;

use SleeperBundle\Application\Entity\SleepEntity;
use SleeperBundle\Domain\Model\Sleep;

class SleepEntityToSleepModelMapper
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