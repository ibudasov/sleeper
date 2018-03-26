<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Infrastructure\Stub;

class StubTest extends TestCase
{
    public function testThatAddedStubCanBeMatchedByUrlAndBody(): void
    {
        $stubCollection = new Stub();
        $expectedResponse = 'ok';
        $stubCollection->add('url', 'jsonedData', $expectedResponse);

        self::assertEquals($expectedResponse, $stubCollection->getStubMatching('url', 'jsonedData'));
    }

    public function testThatEmptyElasticsearchResultIsReturnedWhenStubIsNotFound(): void
    {
        $stubCollection = new Stub();

        $emptyResponse = '{
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

        self::assertEquals($emptyResponse, $stubCollection->getStubMatching('url', 'jsonedData'));
    }
}
