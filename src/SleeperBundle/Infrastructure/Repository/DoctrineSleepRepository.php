<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use SleeperBundle\Application\Entity\SleepDoctrineEntity;
use SleeperBundle\Application\Mapper\SleepEntityToSleepModelMapper;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;
use SleeperBundle\Domain\ValueObject\IdentityInterface;
use SleeperBundle\Domain\ValueObject\SleepId;

/**
 * @codeCoverageIgnore because of Doctrine Repos are not intended to be unit-tested. Integration tests are recommended
 */
class DoctrineSleepRepository extends EntityRepository implements SleepRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSleepByDate(\DateTime $date): Sleep
    {
        $startTime = $date->modify('midnight');
        $endOfPeriod = clone $date;
        $endOfPeriod->modify('tomorrow');

        /** @var SleepDoctrineEntity $sleepEntity */
        $sleepEntity = current($this
            ->createQueryBuilder('sleep')
            ->where('sleep.startTime > :startOfTheDay')
            ->andWhere('sleep.startTime < :endOfTheDay')
            ->setParameter('startOfTheDay', $startTime)
            ->setParameter('endOfTheDay', $endOfPeriod)
            ->getQuery()
            ->getResult());

        if (empty($sleepEntity)) {
            throw new SleepByDateNotFoundException($startTime, $endOfPeriod);
        }

        return SleepEntityToSleepModelMapper::map($sleepEntity);
    }

    /** {@inheritdoc} */
    public function generateId(): IdentityInterface
    {
        return SleepId::generate();
    }
}
