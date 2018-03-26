<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Infrastructure\FakeHttpClient;
use SleeperBundle\Infrastructure\Stub;

class FakeHttpClientTest extends TestCase
{
    public function testThatPostCanBeDone(): void
    {
        $url = 'http://ok.nl';
        $body = \json_encode(['some' => 'data']);
        $expectedResponse = '{
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

        $stubsMock = \Mockery::mock(Stub::class);
        $stubsMock->shouldReceive('getStubMatching')
            ->once()
            ->with($url, $body)
            ->andReturn($expectedResponse);

        $client = new FakeHttpClient($stubsMock);
        $response = $client->postJson($url, $body);

        self::assertInternalType('array', $response);
        self::assertEquals(\json_decode($expectedResponse, true), $response);
    }
}
