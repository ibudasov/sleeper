<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Infrastructure\FakeHttpClient;

class FakeHttpClientTest extends TestCase
{
    public function testThatPostCanBeDone()
    {
        $client = new FakeHttpClient();
        $response = $client->postJson('http://ok.nl', \json_encode(['some' => 'data']));
        self::assertInternalType('array', $response);
    }
}
