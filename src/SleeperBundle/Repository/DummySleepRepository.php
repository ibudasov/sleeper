<?php declare(strict_types=1);

namespace SleeperBundle\Repository;

use SleeperBundle\Model\Sleep;

class DummySleepRepository implements SleepRepositoryInterface
{
    /** {@inheritdoc} */
    public function getSleepOnDate(\DateTime $date): Sleep
    {
        return new Sleep(
            new \DateTime('2017-09-24 22:06:30'),
            new \DateTime('2017-09-25 07:37:53'),
            18779,
            11928,
            3576,
            30707
        );
    }
}
