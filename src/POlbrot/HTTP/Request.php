<?php

namespace POlbrot\HTTP;

/**
 * Class Request
 */
class Request
{
    protected $uri;
    protected $method;
    protected $params = [];

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
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params): void
    {
        $this->params = $params;
    }

    /**
     * Creates instance of a request and returns it
     *
     * @return Request
     */
    public static function createFromGlobals(): Request
    {
        $instance = new self();
        $instance->uri =
            (substr($_SERVER['REQUEST_URI'], -1) === '/') ? $_SERVER['REQUEST_URI'] : $_SERVER['REQUEST_URI'].'/';
        $instance->method = $_SERVER['REQUEST_METHOD'];

        return $instance;
    }
}