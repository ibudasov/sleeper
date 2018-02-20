<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

use SleeperBundle\Application\Entity\SleepElasticsearchEntity;

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
     * @param array $elasticsearchQuery
     * @return SleepElasticsearchEntity|null
     */
    public function getByDate(array $elasticsearchQuery): ?SleepElasticsearchEntity
    {
        $elasticsearchResponse = $this->httpClient->post(
            self::ELASTICSEARCH_BASE,
            $elasticsearchQuery
        );

        if (0 == $elasticsearchResponse['hits']['total']) {
            return null;
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
