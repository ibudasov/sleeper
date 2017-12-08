<?php

declare(strict_types=1);

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetSleepByDateTest extends WebTestCase
{
    /* public function testItReturnsTheSleepIfItExists(): void
    {
        $client = static::createClient();

        $client->request('GET', '/sleep/2017-11-11');

        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode(),
            \substr($client->getResponse()->getContent(), 0, 1000)
        );
    }*/

    public function testThat404IsReturnedWhenSleepIsNotFound(): void
    {
        $client = static::createClient();

        $client->request('GET', '/sleep/2017-11-12');

        $this->assertEquals(
            404,
            $client->getResponse()->getStatusCode(),
            \substr($client->getResponse()->getContent(), 0, 1000)
        );
    }
}
