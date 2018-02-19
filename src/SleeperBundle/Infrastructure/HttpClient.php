<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

/**
 * @codeCoverageIgnore because of Doctrine Repos are not intended to be unit-tested. Integration tests are recommended
 */
class HttpClient implements HttpRequestInterface
{
    private $handle = null;

    public function open(string $url)
    {
        $this->handle = curl_init($url);
    }

    public function setOption(int $name, $value): void
    {
        curl_setopt($this->handle, $name, $value);
    }

    public function execute()
    {
        return curl_exec($this->handle);
    }

    public function getInfo(int $name)
    {
        return curl_getinfo($this->handle, $name);
    }

    public function close()
    {
        curl_close($this->handle);
    }
}
