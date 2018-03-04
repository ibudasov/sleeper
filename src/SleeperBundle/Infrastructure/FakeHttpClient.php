<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

class FakeHttpClient implements HttpRequestInterface
{
    public function postJson(string $toUrl, string $jsonStringToPost): array
    {
        return [];
    }
}
