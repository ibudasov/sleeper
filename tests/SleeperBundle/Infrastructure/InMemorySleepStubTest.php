<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Domain\Model\Sleep;
use SleeperBundle\Infrastructure\Repository\InMemorySleepStub;

class InMemorySleepStubTest extends TestCase
{
    public function testThatStubsOfNeededTypeAreReturned(): void
    {
        $stubFactory = new InMemorySleepStub();

        $returnedStubs = $stubFactory->getStubs();

        self::assertContainsOnlyInstancesOf(Sleep::class, $returnedStubs);
    }
}