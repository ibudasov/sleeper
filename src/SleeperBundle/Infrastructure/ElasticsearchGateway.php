<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

use SleeperBundle\Application\Entity\SleepElasticsearchEntity;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;

class ElasticsearchGateway
{
    const ELASTICSEARCH_BASE = 'localhost:9200/sleep/_search/';
    const ELASTICSEARCH_DATE_FORMAT = 'Y/m/d H:i:s';

    /** @var HttpRequestInterface */
    private $httpClient;

    /** @param HttpRequestInterface $httpClient */
    public function __construct(HttpRequestInterface $httpClient)
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
            ]
        );

        if (0 == $elasticsearchResponse['hits']['total']) {
            throw new SleepByDateNotFoundException($startTime, $endOfPeriod);
        }

        $firstHit = \current($elasticsearchResponse['hits']['hits'])['_source'];

        return new SleepElasticsearchEntity(
            $firstHit['id'],
            \DateTime::createFromFormat(self::ELASTICSEARCH_DATE_FORMAT, $firstHit['startTime']),
            \DateTime::createFromFormat(self::ELASTICSEARCH_DATE_FORMAT, $firstHit['endTime']),
            $firstHit['deepSleepSeconds'],
            $firstHit['lightSleepSeconds'],
            $firstHit['awakeSeconds'],
            $firstHit['totalSleepSeconds']
        );
    }


}
