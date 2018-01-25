<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

use GuzzleHttp;
use GuzzleHttp\Client;
use SleeperBundle\Application\Entity\SleepElasticsearchEntity;

class ElasticsearchGateway
{
    const ELASTICSEARCH_BASE = 'localhost:9200/sleep/_search/';

    /** @var Client */
    private $httpClient;

    /** @param Client $httpClient */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param \DateTime $sleepDate
     *
     * @return SleepElasticsearchEntity
     */
    public function getByDate(\DateTime $sleepDate): SleepElasticsearchEntity
    {
        $elasticsearchResponse = $this->httpClient->post(
            self::ELASTICSEARCH_BASE,
            [
                GuzzleHttp\RequestOptions::JSON => ['query' => ['match' => ['deepSleepSeconds' => 1],
                ],
                ],
            ]
        );

        return new SleepElasticsearchEntity();
    }
}
