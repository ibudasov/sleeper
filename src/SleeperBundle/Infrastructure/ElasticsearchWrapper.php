<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;


use GuzzleHttp\Client;

class ElasticsearchWrapper
{
    /** @var Client */
    private $httpClient;

    /**
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }
}