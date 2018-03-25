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

        $stubsMock = \Mockery::mock(Stub::class);
        $stubsMock->shouldReceive('getStubMatching')
            ->once()
            ->with($url, $body)
            ->andReturn('hi kate!');

        $client = new FakeHttpClient($stubsMock);
        $response = $client->postJson($url, $body);

        self::assertInternalType('array', $response);
        self::assertEquals(['hi kate!'], $response);
    }
}
