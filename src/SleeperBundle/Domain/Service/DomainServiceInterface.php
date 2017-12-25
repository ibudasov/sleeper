<?php

declare(strict_types=1);

namespace SleeperBundle\Domain\Service;

use SleeperBundle\Domain\Entity\Sleep;

/**
 * Suppose to be stateless
 * ​Interface belongs to domain, implementation belongs to infrastructure
 * Generalized DomainService should be named after operation it provides
 * and have at least one public method -- execute(().
 */
interface DomainServiceInterface
{
    /**
     * @param Sleep $sleep
     *
     * @return mixed
     */
    public function execute(Sleep $sleep);
}
