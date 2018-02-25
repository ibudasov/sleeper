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
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;

class ElasticsearchSleepRepositoryTest extends TestCase
{
    const ELASTICSEARCH_BASE = 'localhost:9200/sleep/_search/';
    const ELASTICSEARCH_DATE_FORMAT = 'Y/m/d H:i:s';
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
        $startOfPeriod = $requestedDate->modify('midnight');
        $endOfPeriod = clone $requestedDate;
        $endOfPeriod->modify('tomorrow');

        $elasticsearchSleepEntityMock = \Mockery::mock(SleepElasticsearchEntity::class);

        $elasticsearchQuery = [
            'query' => [
                'constant_score' => [
                    'filter' => [
                        'range' => [
                            'startTime' => [
                                'gte' => $startOfPeriod->format(self::ELASTICSEARCH_DATE_FORMAT),
                                'lte' => $endOfPeriod->format(self::ELASTICSEARCH_DATE_FORMAT),
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->gatewayMock->shouldReceive('getByDate')
            ->once()
            ->with($elasticsearchQuery)
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

    public function testThatExceptionIsthrownWhenSleepNotFoundByDate(): void
    {
        $this->expectException(SleepByDateNotFoundException::class);

        $this->gatewayMock->shouldReceive('getByDate')
            ->once()
            ->andReturnNull();

        $repo = new ElasticsearchSleepRepository(
            $this->gatewayMock,
            $this->mapperMock
        );

        $repo->getSleepByDate(new \DateTime());
    }
}
