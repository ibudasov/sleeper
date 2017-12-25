<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure\Repository;

use SleeperBundle\Domain\Entity\Sleep;
use SleeperBundle\Domain\ValueObject\SleepId;

class InMemorySleepStub
{
    /** @return Sleep[] */
    public function getStubs(): array
    {
        return [
            $this->getTodaySleepStub(),
        ];
    }

    /** @return Sleep */
    private function getTodaySleepStub(): Sleep
    {
        return new Sleep(
            SleepId::generate(),
            new \DateTime(),
            new \DateTime(),
            1,
            2,
            3,
            4
        );
    }
}
