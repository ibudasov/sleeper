<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

class FakeHttpClient implements HttpRequestInterface
{
    /**
     * @var Stub
     */
    private $stub;

    /**
     * @param Stub $stub
     */
    public function __construct(Stub $stub)
    {
        $this->stub = $stub;
    }

    /**
     * @param string $toUrl
     * @param string $jsonStringToPost
     *
     * @return array
     */
    public function postJson(string $toUrl, string $jsonStringToPost): array
    {
        return [$this->stub->getStubMatching($toUrl, $jsonStringToPost)];
    }
}
