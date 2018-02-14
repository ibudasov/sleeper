<?php

declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Entity\SleepElasticsearchEntity;
use SleeperBundle\Application\Mapper\SleepElasticsearchToDomainEntityMapper;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\ValueObject\IdentityInterface;
use SleeperBundle\Infrastructure\ElasticsearchGateway;
use SleeperBundle\Infrastructure\Repository\ElasticsearchSleepRepository;

class ElasticsearchSleepRepositoryTest extends TestCase
{
    /** @var ElasticsearchGateway|MockInterface */
    private $gatewayMock;
    /** @var SleepElasticsearchToDomainEntityMapper|MockInterface */
    private $mapperMock;

    protected function setUp(): void
    {
        $this->gatewayMock = Mockery::mock(ElasticsearchGateway::class);
        $this->mapperMock = Mockery::mock(SleepElasticsearchToDomainEntityMapper::class);
    }

    public function testThatSleepCanBeRetrievedByDate(): void
    {
        $requestedDate = new \DateTime();

        $elasticsearchSleepEntityMock = \Mockery::mock(SleepElasticsearchEntity::class);

        $this->gatewayMock->shouldReceive('getByDate')
            ->once()
            ->with($requestedDate)
            ->andReturn($elasticsearchSleepEntityMock);

        $this->mapperMock->shouldReceive('map')
            ->once()
            ->with($elasticsearchSleepEntityMock);

        $repo = new ElasticsearchSleepRepository(
            $this->gatewayMock,
            $this->mapperMock
        );

        $returnedSleep = $repo->getSleepByDate($requestedDate);

        self::assertInstanceOf(Sleep::class, $returnedSleep);
        self::assertAttributeLessThanOrEqual($requestedDate, 'startTime', $returnedSleep);
    }

    public function testThatIdCanBeGenerated(): void
    {
        $repo = new ElasticsearchSleepRepository(
            $this->gatewayMock,
            $this->mapperMock
        );

        self::assertInstanceOf(IdentityInterface::class, $repo->generateId());
    }
}
