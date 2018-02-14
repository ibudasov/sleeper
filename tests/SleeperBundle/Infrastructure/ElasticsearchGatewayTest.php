<?php

declare(strict_types=1);

namespace Tests\SleeperBundle\Infrastructure;

use GuzzleHttp;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Entity\SleepElasticsearchEntity;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Infrastructure\ElasticsearchGateway;

class ElasticsearchGatewayTest extends TestCase
{
    const ELASTICSEARCH_BASE = 'localhost:9200/sleep/_search/';
    const ELASTICSEARCH_DATE_FORMAT = 'Y-m-d H:i:s';

    public function testThatSleepCanBeRetrieved(): void
    {
        $requestedDate = new \DateTime();
        $startOfPeriod = $requestedDate->modify('midnight');
        $endOfPeriod = clone $requestedDate;
        $endOfPeriod->modify('tomorrow');

        $httpClientMock = \Mockery::mock(Client::class);
        $httpClientMock->shouldReceive('post')
            ->once()
            ->with(
                self::ELASTICSEARCH_BASE,
                [
                    GuzzleHttp\RequestOptions::JSON => [
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
                    ],
                ]
            )
            ->andReturn(
            '{
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
                }'
            );

        $sleep = (new ElasticsearchGateway($httpClientMock))->getByDate($requestedDate);

        self::assertInstanceOf(SleepElasticsearchEntity::class, $sleep);
        self::assertAttributeGreaterThanOrEqual($startOfPeriod, 'startTime', $sleep);
    }

    public function testThatExceptionIsThrownWhenSleepNotFoundByDate(): void
    {
        $this->expectException(SleepByDateNotFoundException::class);
        $requestedDate = new \DateTime();
        $startTime = $requestedDate->modify('midnight');
        $endOfPeriod = clone $requestedDate;
        $endOfPeriod->modify('tomorrow');

        $httpClientMock = \Mockery::mock(Client::class);
        $httpClientMock->shouldReceive('post')
            ->once()
            ->with(
                self::ELASTICSEARCH_BASE,
                [
                    GuzzleHttp\RequestOptions::JSON => [
                        'query' => [
                            'constant_score' => [
                                'filter' => [
                                    'range' => [
                                        'startTime' => [
                                            'gte' => $startTime->format(self::ELASTICSEARCH_DATE_FORMAT),
                                            'lte' => $endOfPeriod->format(self::ELASTICSEARCH_DATE_FORMAT),
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
            )
            ->andReturn('{
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
                }'
            );

        (new ElasticsearchGateway($httpClientMock))->getByDate($requestedDate);
    }
}
