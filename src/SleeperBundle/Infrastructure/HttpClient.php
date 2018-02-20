<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

/**
 * @todo: investigate & unit-test it
 * @codeCoverageIgnore because of I don't know how to test it ATM
 */
class HttpClient implements HttpRequestInterface
{
    private $handle = null;

    /**
     * @param string $urlToPost
     * @param array  $dataToPost
     *
     * @return array
     */
    public function post(string $urlToPost, array $dataToPost): array
    {
        $this->open($urlToPost);

        $this->setOption(CURLOPT_POST, 1);
        $this->setOption(CURLOPT_POSTFIELDS, http_build_query($dataToPost));
        $this->setOption(CURLOPT_RETURNTRANSFER, true);

        $response = $this->execute();

        $code = $this->getInfo(CURLINFO_HTTP_CODE);
        $type = $this->getInfo(CURLINFO_CONTENT_TYPE);

        $this->close();

        return \json_decode($response, true);
    }

    /**
     * @param string $url
     */
    private function open(string $url)
    {
        $this->handle = curl_init($url);
    }

    /**
     * @param int $name
     * @param $value
     */
    private function setOption(int $name, $value): void
    {
        curl_setopt($this->handle, $name, $value);
    }

    /**
     * @return mixed
     */
    private function execute()
    {
        return curl_exec($this->handle);
    }

    /**
     * @param int $name
     *
     * @return mixed
     */
    private function getInfo(int $name)
    {
        return curl_getinfo($this->handle, $name);
    }

    private function close(): void
    {
        curl_close($this->handle);
    }
}
