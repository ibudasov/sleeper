<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

interface HttpRequestInterface
{
    /**
     * @param string $url
     *
     * @return mixed
     */
    public function open(string $url);

    /**
     * @param int $name
     * @param $value
     *
     * @return mixed
     */
    public function setOption(int $name, $value);

    /**
     * @return mixed
     */
    public function execute();

    /**
     * @param int $name
     *
     * @return mixed
     */
    public function getInfo(int $name);

    /**
     * @return mixed
     */
    public function close();
}
