<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

class FakeHttpClient implements HttpRequestInterface
{
    /**
     * @param string $toUrl
     * @param string $jsonStringToPost
     *
     * @return array
     */
    public function postJson(string $toUrl, string $jsonStringToPost): array
    {
        return [];
    }
}
