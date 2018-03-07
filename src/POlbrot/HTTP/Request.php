<?php

namespace POlbrot\HTTP;

/**
 * Class Request
 */
class Request
{
    private static $uri;

    /**
     * @return mixed
     */
    public static function getUri()
    {
        return self::$uri;
    }

    /**
     * @return Request
     */
    public static function createFromGlobals()
    {
        self::$uri = $_SERVER['REQUEST_URI'];

        return new self();
    }
}