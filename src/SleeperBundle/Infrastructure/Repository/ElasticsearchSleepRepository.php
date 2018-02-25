<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure\Repository;

use SleeperBundle\Application\Mapper\SleepElasticsearchToDomainEntityMapper;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;
use SleeperBundle\Domain\ValueObject\IdentityInterface;
use SleeperBundle\Domain\ValueObject\SleepId;
use SleeperBundle\Infrastructure\ElasticsearchGateway;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;

class ElasticsearchSleepRepository implements SleepRepositoryInterface
{
    /** @var ElasticsearchGateway */
    private $elasticsearchGateway;
    /** @var SleepElasticsearchToDomainEntityMapper */
    private $mapper;

    /**
     * @param ElasticsearchGateway                   $elasticsearchGateway
     * @param SleepElasticsearchToDomainEntityMapper $mapper
     */
    public function __construct(
        ElasticsearchGateway $elasticsearchGateway,
        SleepElasticsearchToDomainEntityMapper $mapper
    ) {
        $this->elasticsearchGateway = $elasticsearchGateway;
        $this->mapper = $mapper;
    }

    /** {@inheritdoc} */
    public function generateId(): IdentityInterface
    {
        return SleepId::generate();
    }

    /** {@inheritdoc} */
    public function getSleepByDate(\DateTime $date): Sleep
    {
        $startTime = $date->modify('midnight');
        $endOfPeriod = clone $date;
        $endOfPeriod->modify('tomorrow');

        $elasticsearchQuery = [
            'query' => [
                'constant_score' => [
                    'filter' => [
                        'range' => [
                            'startTime' => [
                                'gte' => $startTime->format(ElasticsearchGateway::ELASTICSEARCH_DATE_FORMAT),
                                'lte' => $endOfPeriod->format(ElasticsearchGateway::ELASTICSEARCH_DATE_FORMAT),
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $elasticsearchEntity = $this->elasticsearchGateway->getByDate($elasticsearchQuery);

        if (null === $elasticsearchEntity) {
            throw new SleepByDateNotFoundException($startTime, $endOfPeriod);
        }

        return $this->mapper->map($elasticsearchEntity);
    }
}
