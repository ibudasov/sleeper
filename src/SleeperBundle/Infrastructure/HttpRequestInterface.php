<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

interface HttpRequestInterface
{
    function post(string $toUrl, array $dataToPost): array;
}
