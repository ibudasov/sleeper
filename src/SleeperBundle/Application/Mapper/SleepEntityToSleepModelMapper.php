<?php

declare(strict_types=1);

namespace SleeperBundle\Application\Mapper;

use SleeperBundle\Application\Entity\SleepDoctrineEntity;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\ValueObject\SleepId;

class SleepEntityToSleepModelMapper
{
    /**
     * @param SleepDoctrineEntity $entity
     *
     * @return Sleep
     */
    public static function map(SleepDoctrineEntity $entity): Sleep
    {
        return new Sleep(
            SleepId::createFrom($entity->getId()),
            $entity->getStartTime(),
            $entity->getEndTime(),
            $entity->getDeepSleepSeconds(),
            $entity->getLightSleepSeconds(),
            $entity->getAwakeSeconds(),
            $entity->getTotalSleepSeconds()
        );
    }
}
