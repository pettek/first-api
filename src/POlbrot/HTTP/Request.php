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
     *
     */
    public function createFromGlobals()
    {
        $this->uri = $_SERVER['REQUEST_URI'];

        return $this;
    }
}