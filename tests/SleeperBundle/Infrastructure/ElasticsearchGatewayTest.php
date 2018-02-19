<?php

declare(strict_types=1);

namespace Tests\SleeperBundle\Infrastructure;

use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Entity\SleepElasticsearchEntity;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Infrastructure\ElasticsearchGateway;
use SleeperBundle\Infrastructure\HttpRequestInterface;

class ElasticsearchGatewayTest extends TestCase
{
    const ELASTICSEARCH_BASE = 'localhost:9200/sleep/_search/';
    const ELASTICSEARCH_DATE_FORMAT = 'Y/m/d H:i:s';

    public function testThatSleepCanBeRetrieved(): void
    {
        $requestedDate = new \DateTime();
        $startOfPeriod = $requestedDate->modify('midnight');
        $endOfPeriod = clone $requestedDate;
        $endOfPeriod->modify('tomorrow');

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
        $elasticsearchResponse = '{
            "took": 10,
            "timed_out": false,
            "_shards": {
                "total": 5,
                "successful": 5,
                "skipped": 0,
                "failed": 0
            },
            "hits": {
                "total": 1,
                "max_score": 1,
                "hits": [
                    {
                        "_index": "sleep",
                        "_type": "night",
                        "_id": "1",
                        "_score": 1,
                        "_source": {
                            "id": "111",
                            "startTime": "'.$startOfPeriod->format(self::ELASTICSEARCH_DATE_FORMAT).'",
                            "endTime": "'.$endOfPeriod->format(self::ELASTICSEARCH_DATE_FORMAT).'",
                            "lightSleepSeconds": 1,
                            "deepSleepSeconds": 2,
                            "awakeSeconds": 3,
                            "totalSleepSeconds": 4
                        }
                    }
                ]
            }
        }';

        $httpClientMock = \Mockery::mock(HttpRequestInterface::class);
        $httpClientMock->shouldReceive('post')->once()
            ->with(
                self::ELASTICSEARCH_BASE,
                $elasticsearchQuery
            )
            ->andReturn(\json_decode($elasticsearchResponse, true));

        $sleep = (new ElasticsearchGateway($httpClientMock))->getByDate($requestedDate);

        self::assertInstanceOf(SleepElasticsearchEntity::class, $sleep);
        self::assertAttributeGreaterThanOrEqual($startOfPeriod, 'startTime', $sleep);
    }

    public function testThatExceptionIsThrownWhenSleepNotFoundByDate(): void
    {
        $this->expectException(SleepByDateNotFoundException::class);
        $requestedDate = new \DateTime();
        $startOfPeriod = $requestedDate->modify('midnight');
        $endOfPeriod = clone $requestedDate;
        $endOfPeriod->modify('tomorrow');

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
        $elasticsearchResponse = '{
            "took": 10,
            "timed_out": false,
            "_shards": {
                "total": 5,
                "successful": 5,
                "skipped": 0,
                "failed": 0
            },
            "hits": {
                "total": 0,
                "max_score": null,
                "hits": [
                ]
            }
        }';

        $httpClientMock = \Mockery::mock(HttpRequestInterface::class);
        $httpClientMock->shouldReceive('post')->once()
            ->with(
                self::ELASTICSEARCH_BASE,
                $elasticsearchQuery
            )
            ->andReturn(\json_decode($elasticsearchResponse, true));

        (new ElasticsearchGateway($httpClientMock))->getByDate($requestedDate);
    }
}
