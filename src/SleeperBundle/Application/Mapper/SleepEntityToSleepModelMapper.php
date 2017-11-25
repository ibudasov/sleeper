<?php declare(strict_types=1);

namespace SleeperBundle\Application\Mapper;

use SleeperBundle\Application\Entity\SleepEntity;
use SleeperBundle\Domain\Model\Sleep;
use SleeperBundle\Domain\ValueObject\SleepId;

class SleepEntityToSleepModelMapper
{
    /**
     * @param SleepEntity $entity
     * @return Sleep
     */
    public static function map(SleepEntity $entity): Sleep
    {
        return new Sleep(
            SleepId::generate(),
            $entity->getStartTime(),
            $entity->getEndTime(),
            $entity->getDeepSleepSeconds(),
            $entity->getLightSleepSeconds(),
            $entity->getAwakeSeconds(),
            $entity->getTotalSleepSeconds()
        );
    }
}
