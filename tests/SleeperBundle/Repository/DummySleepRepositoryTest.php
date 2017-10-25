<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Model\Sleep;
use SleeperBundle\Repository\DummySleepRepository;

class DummySleepRepositoryTest extends TestCase
{
    public function testThatDummyRepositoryReturnsSleepModel()
    {
        $repository = new DummySleepRepository();
        self::assertInstanceOf(Sleep::class, $repository->getSleepOnDate(new \DateTime('now')));
    }
}
