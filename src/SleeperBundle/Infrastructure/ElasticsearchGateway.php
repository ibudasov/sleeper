<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

use GuzzleHttp;
use GuzzleHttp\Client;
use SleeperBundle\Application\Entity\SleepElasticsearchEntity;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;

class ElasticsearchGateway
{
    const ELASTICSEARCH_BASE = 'localhost:9200/sleep/_search/';
    const ELASTICSEARCH_DATE_FORMAT = 'Y-m-d H:i:s';

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
        $startTime = $sleepDate->modify('midnight');
        $endOfPeriod = clone $sleepDate;
        $endOfPeriod->modify('tomorrow');

        $elasticsearchResponse = $this->httpClient->post(
            self::ELASTICSEARCH_BASE,
            [
                GuzzleHttp\RequestOptions::JSON => [
                    'query' => [
                        'constant_score' => [
                            'filter' => [
                                'range' => [
                                    'startTime' => [
                                        'gte' => $startTime->format(self::ELASTICSEARCH_DATE_FORMAT),
                                        'lte' => $endOfPeriod->format(self::ELASTICSEARCH_DATE_FORMAT),
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $decoded = \json_decode($elasticsearchResponse);
        if($decoded->hits->total == 0) {
            throw new SleepByDateNotFoundException($startTime, $endOfPeriod);
        }

        $firstHit =  \current($decoded->hits->hits)->_source;

        return new SleepElasticsearchEntity(
            $firstHit->id,
            \DateTime::createFromFormat(self::ELASTICSEARCH_DATE_FORMAT, $firstHit->startTime),
            \DateTime::createFromFormat(self::ELASTICSEARCH_DATE_FORMAT, $firstHit->endTime),
            $firstHit->deepSleepSeconds,
            $firstHit->lightSleepSeconds,
            $firstHit->awakeSeconds,
            $firstHit->totalSleepSeconds
        );
    }
}
