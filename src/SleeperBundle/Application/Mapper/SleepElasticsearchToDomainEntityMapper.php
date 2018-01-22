<?php

declare(strict_types=1);

namespace SleeperBundle\Application\Mapper;

use SleeperBundle\Application\Entity\SleepElasticsearchEntity;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\ValueObject\SleepId;

class SleepElasticsearchToDomainEntityMapper
{
    /**
     * @param SleepElasticsearchEntity $elasticsearchEntity
     *
     * @return Sleep
     */
    public function map(SleepElasticsearchEntity $elasticsearchEntity): Sleep
    {
        return new Sleep(
            SleepId::generate(),
            $elasticsearchEntity->getStartTime(),
            $elasticsearchEntity->getEndTime(),
            $elasticsearchEntity->getDeepSleepSeconds(),
            $elasticsearchEntity->getLightSleepSeconds(),
            $elasticsearchEntity->getAwakeSeconds(),
            $elasticsearchEntity->getTotalSleepSeconds()
        );
    }
}
