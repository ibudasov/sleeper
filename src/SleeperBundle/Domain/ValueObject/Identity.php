<?php declare(strict_types=1);

namespace SleeperBundle\Domain\ValueObject;

interface Identity
{
    /**
     * Id can be auto-generated if needed.
     * For example it's useful right before saving an entity,
     * when you don't really care of returning the Id
     *
     * @return Identity
     */
    public static function generate();

    /**
     * There must be possibility to assign an Id manually.
     * Example: you create a command for creating an entity.
     * Command will be executed asynchronously, but you still want to return id to frontend
     *
     * @param string $sleepIdValue
     *
     * @return Identity
     */
    public static function createFrom(string $sleepIdValue): Identity;

    /**
     * Id can be converted to string in order to save it to database
     *
     * @return string
     */
    public function __toString(): string;
}
