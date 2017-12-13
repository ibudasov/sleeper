<?php

declare(strict_types=1);

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetSleepByDateTest extends WebTestCase
{
    public function testItReturnsTheSleepIfItExists(): void
    {
        $client = static::createClient();

        $today = (new \DateTime())->format('Y-m-d');

        $crawler = $client->request('GET', '/sleep/' . $today);
        $errorMessage = (500 === $client->getResponse()->getStatusCode())
            ? $crawler->filter('title')->html()
            : null;

        $this->assertEquals(
            200
            , $client->getResponse()->getStatusCode()
            , $errorMessage
        );
    }

    public function testThat404IsReturnedWhenSleepIsNotFound(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/sleep/2017-11-12');
        $errorMessage = (500 === $client->getResponse()->getStatusCode())
            ? $crawler->filter('title')->html()
            : null;

        $this->assertEquals(
            404
            , $client->getResponse()->getStatusCode()
            , $errorMessage
        );
    }
}
