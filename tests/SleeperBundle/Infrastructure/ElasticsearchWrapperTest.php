<?php

declare(strict_types=1);

namespace Tests\SleeperBundle\Infrastructure;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Infrastructure\ElasticsearchWrapper;

class ElasticsearchWrapperTest extends TestCase
{
    public function testThatSleepCanBeRetrieved(): void
    {
        $httpClientMock = \Mockery::mock(Client::class);

        $wrapper = new ElasticsearchWrapper($httpClientMock);

        self::assertInstanceOf(ElasticsearchWrapper::class, $wrapper);
    }
}