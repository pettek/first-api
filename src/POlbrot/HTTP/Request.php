<?php

namespace POlbrot\HTTP;

/**
 * Class Request
 */
class Request
{
    protected $uri;

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Creates instance of a request and returns it
     * @return Request
     */
    public static function createFromGlobals()
    {
        $instance = new self();
        $instance->uri = $_SERVER['REQUEST_URI'];

        return $instance;
    }
}