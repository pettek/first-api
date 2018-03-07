<?php

namespace POlbrot\HTTP;

/**
 * Class Request
 */
class Request
{
    protected $uri;
    protected $method;

    /**
     * @return mixed
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Creates instance of a request and returns it
     *
     * @return Request
     */
    public static function createFromGlobals(): Request
    {
        $instance = new self();
        $instance->uri = $_SERVER['REQUEST_URI'];
        $instance->method = $_SERVER['REQUEST_METHOD'];

        return $instance;
    }
}