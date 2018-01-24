<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Infrastructure\Repository\ElasticsearchSleepRepository;

class ElasticsearchSleepRepositoryTest extends TestCase
{
    /** @var Client|MockInterface */
    private $httpClientMock;

    protected function setUp(): void
    {
        $this->httpClientMock = Mockery::mock(Client::class);
    }

    public function testThatSleepCanBeRetrievedByDate(): void
    {
        $repo = new ElasticsearchSleepRepository($this->httpClientMock);

        $this->httpClientMock->shouldReceive('get')
            ->once()
            ->with('localhost:9200/sleep/night')
            ->andReturn('1111');

        self::assertInstanceOf(Sleep::class, $repo->getSleepByDate(new \DateTime()));
    }
}
