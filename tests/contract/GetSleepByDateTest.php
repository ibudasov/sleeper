<?php

declare(strict_types=1);

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetSleepByDateTest extends WebTestCase
{
    public function testItReturnsTheSleepIfItExists(): void
    {
        $client = static::createClient();

        $today = (new \DateTime())->format('Y-m-d');

        $client->request('GET', '/sleep/' . $today);

        $this->assertEquals(
            200
            , $client->getResponse()->getStatusCode()
        );
    }

    public function testThat404IsReturnedWhenSleepIsNotFound(): void
    {
        $client = static::createClient();

        $client->request('GET', '/sleep/2017-11-12');

        $this->assertEquals(
            404
            , $client->getResponse()->getStatusCode()
        );
    }
}
