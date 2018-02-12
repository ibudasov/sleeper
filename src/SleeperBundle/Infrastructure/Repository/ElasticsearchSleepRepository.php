<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure\Repository;

use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;
use SleeperBundle\Domain\ValueObject\IdentityInterface;
use SleeperBundle\Domain\ValueObject\SleepId;
use SleeperBundle\Infrastructure\ElasticsearchGateway;

class ElasticsearchSleepRepository implements SleepRepositoryInterface
{
    /**
     * @var ElasticsearchGateway
     */
    private $client;

    /**
     * @param ElasticsearchGateway $client
     */
    public function __construct(ElasticsearchGateway $client)
    {
        $this->client = $client;
    }

    /** {@inheritdoc} */
    public function generateId(): IdentityInterface
    {
        return SleepId::generate();
    }

    /** {@inheritdoc} */
    public function getSleepByDate(\DateTime $date): Sleep
    {
        $this->client->getByDate($date);

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
