<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Infrastructure\Repository\ElasticsearchSleepRepository;

class ElasticsearchSleepRepositoryTest extends TestCase
{
    public function testThatSleepCanBeRetrievedByDate(): void
    {
        $repo = new ElasticsearchSleepRepository();

        self::assertInstanceOf(\SleeperBundle\Domain\Entity\Sleep::class, $repo->getSleepByDate(new \DateTime()));
    }

}