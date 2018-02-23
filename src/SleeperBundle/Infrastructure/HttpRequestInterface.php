<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

interface HttpRequestInterface
{
    public function postJson(string $toUrl, string $jsonStringToPost): array;
}
