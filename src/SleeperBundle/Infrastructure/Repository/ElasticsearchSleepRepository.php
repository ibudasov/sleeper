<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure\Repository;

use SleeperBundle\Application\Mapper\SleepElasticsearchToDomainEntityMapper;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;
use SleeperBundle\Domain\ValueObject\IdentityInterface;
use SleeperBundle\Domain\ValueObject\SleepId;
use SleeperBundle\Infrastructure\ElasticsearchGateway;

class ElasticsearchSleepRepository implements SleepRepositoryInterface
{
    /** @var ElasticsearchGateway */
    private $client;
    /** @var SleepElasticsearchToDomainEntityMapper */
    private $mapper;

    /**
     * @param ElasticsearchGateway $client
     * @param SleepElasticsearchToDomainEntityMapper $mapper
     */
    public function __construct(ElasticsearchGateway $client, SleepElasticsearchToDomainEntityMapper $mapper)
    {
        $this->client = $client;
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
        $elasticsearchEntity = $this->client->getByDate($date);

        return $this->mapper->map($elasticsearchEntity);
    }
}
