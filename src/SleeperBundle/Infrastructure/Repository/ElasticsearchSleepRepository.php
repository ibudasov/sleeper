<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure\Repository;

use GuzzleHttp\Client;
use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;
use SleeperBundle\Domain\ValueObject\IdentityInterface;
use SleeperBundle\Domain\ValueObject\SleepId;

class ElasticsearchSleepRepository implements SleepRepositoryInterface
{
    private const ELASTICSEARCH_BASE_PATH = 'localhost:9200/sleep/night';

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /** {@inheritdoc} */
    public function generateId(): IdentityInterface
    {
        return SleepId::generate();
    }

    /** {@inheritdoc} */
    public function getSleepByDate(\DateTime $date): Sleep
    {
        $this->httpClient->get(self::ELASTICSEARCH_BASE_PATH);

        return new Sleep(
            $this->generateId(),
            new \DateTime(),
            new \DateTime(),
            1,
            2,
            3,
            4
        );
    }
}
