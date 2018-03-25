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

    public function testThatExceptionIsThrownWhenStubIsNotFound(): void
    {
        $this->expectException(\LogicException::class);
        $stubCollection = new Stub();

        $stubCollection->getStubMatching('url', 'jsonedData');
    }
}
