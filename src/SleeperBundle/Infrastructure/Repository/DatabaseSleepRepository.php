<?php declare(strict_types=1);

namespace SleeperBundle\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use SleeperBundle\Application\Entity\SleepEntity;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Application\Mapper\SleepEntityToSleepModelMapper;
use SleeperBundle\Domain\Model\Sleep;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;
use PHPUnit\Framework\TestCase;

/**
 * @codeCoverageIgnore
 */
class DatabaseSleepRepository extends EntityRepository implements SleepRepositoryInterface
{
    /**
     * @param \DateTimeImmutable $date
     * @return Sleep
     * @throws SleepByDateNotFoundException
     */
    public function getSleepByDate(\DateTimeImmutable $date): Sleep
    {
        $startTime = $date->modify('midnight');
        $endOfPeriod = clone($date);
        $endOfPeriod->modify('tomorrow');

        /** @var SleepEntity $sleepEntity */
        $sleepEntity = current($this
            ->createQueryBuilder('sleep')
            ->where('sleep.startTime > :startOfTheDay')
            ->andWhere('sleep.startTime < :endOfTheDay')
            ->setParameter('startOfTheDay', $startTime)
            ->setParameter('endOfTheDay', $endOfPeriod)
            ->getQuery()
            ->getResult());

        if (empty($sleepEntity)) {
            $message = \sprintf(
                'No sleep found between "%s" and "%s"',
                $startTime->format('Y-m-d'),
                $endOfPeriod->format('Y-m-d')
            );

            throw new SleepByDateNotFoundException($message);
        }

        return SleepEntityToSleepModelMapper::map($sleepEntity);
    }
}
