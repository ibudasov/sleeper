<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

class Stub
{
    /**
     * @var array
     */
    private $stubCollection = [];

    /**
     * @param string $postUrl
     * @param string $postJsonBody
     * @param string $response
     */
    public function add(string $postUrl, string $postJsonBody, string $response): void
    {
        $this->stubCollection = [
            $postUrl.' -- '.$postJsonBody => $response,
        ];
    }

    /**
     * @param string $url
     * @param string $body
     *
     * @return string
     */
    public function getStubMatching(string $url, string $body): string
    {
        if (isset($this->stubCollection[$url . ' -- ' . $body])) {
            return $this->stubCollection[$url . ' -- ' . $body];
        }

        throw new \LogicException('A stub not found for URL "' . $url . '" and body "' . $body . '"');
    }
}
