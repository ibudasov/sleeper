<?php declare(strict_types=1);

namespace SleeperBundle\Repository;

use Doctrine\ORM\EntityRepository;
use SleeperBundle\Application\Entity\SleepEntity;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Application\Mapper\SleepEntityToSleepModelMapper;
use SleeperBundle\Domain\Model\Sleep;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;

class DatabaseSleepRepository extends EntityRepository implements SleepRepositoryInterface
{
    /**
     * @param \DateTime $date
     * @return Sleep
     * @throws SleepByDateNotFoundException
     */
    public function getSleepByDate(\DateTime $date): Sleep
    {
        $startTime = $date->modify('midnight');
        $endOfPeriod = clone($date);
        $endOfPeriod->modify('tomorrow');

        /** @var SleepEntity $sleepEntity */
        $sleepEntity = current($this
            ->createQueryBuilder('sleep')
            ->where('sleep.startTime > :startOfTheDay')
            ->andWhere('sleep.endTime < :endOfTheDay')
            ->setParameter('startOfTheDay', $startTime)
            ->setParameter('endOfTheDay', $endOfPeriod)
            ->getQuery()
            ->getResult());

        if(empty($sleepEntity)) {
            throw new SleepByDateNotFoundException(\sprintf(
                'No sleep found between "%s" and "%s"',
                $startTime->format('Y-m-d'),
                $endOfPeriod->format('Y-m-d')
            ));
        }

        return SleepEntityToSleepModelMapper::map($sleepEntity);
    }
}