<?php

declare(strict_types=1);

namespace Tests\SleeperBundle\Infrastructure;

use GuzzleHttp;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Entity\SleepElasticsearchEntity;
use SleeperBundle\Infrastructure\ElasticsearchGateway;

class ElasticsearchGatewayTest extends TestCase
{
    const ELASTICSEARCH_BASE = 'localhost:9200/sleep/_search/';

    public function testThatSleepCanBeRetrieved(): void
    {
        $httpClientMock = \Mockery::mock(Client::class);
        $httpClientMock->shouldReceive('post')
            ->once()
            ->with(
                self::ELASTICSEARCH_BASE,
                [
                    GuzzleHttp\RequestOptions::JSON => ['query' => ['match' => ['deepSleepSeconds' => 1],
                    ],
                    ],
                ]
            )
            ->andReturn(\json_encode([]));

        $wrapper = new ElasticsearchGateway($httpClientMock);

        $sleep = $wrapper->getByDate(new \DateTime());

        self::assertInstanceOf(SleepElasticsearchEntity::class, $sleep);
    }
}
