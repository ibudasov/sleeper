<?php

declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Entity\SleepElasticsearchEntity;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Infrastructure\ElasticsearchGateway;
use SleeperBundle\Infrastructure\Repository\ElasticsearchSleepRepository;

class ElasticsearchSleepRepositoryTest extends TestCase
{
    /** @var ElasticsearchGateway|MockInterface */
    private $gatewayMock;

    protected function setUp(): void
    {
        $this->gatewayMock = Mockery::mock(ElasticsearchGateway::class);
    }

    public function testThatSleepCanBeRetrievedByDate(): void
    {
        $requestedDate = new \DateTime();

        $this->gatewayMock->shouldReceive('getByDate')
            ->once()
            ->with($requestedDate)
            ->andReturn(\Mockery::mock(SleepElasticsearchEntity::class));

        $repo = new ElasticsearchSleepRepository($this->gatewayMock);

        self::assertInstanceOf(Sleep::class, $repo->getSleepByDate($requestedDate));
    }
}
