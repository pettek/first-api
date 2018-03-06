<?php

namespace POlbrot\HTTP;

/**
 * Class Request
 */
class Request
{
    public $uri;
    public $get;
    public $post;

    private function __construct($uri, $get, $post)
    {
        $this->uri = $uri;
        $this->get = $get;
        $this->post = $post;
    }


    public static function createFromGlobals()
    {
        return new Request($_SERVER['REQUEST_URI'], $_GET, $_POST);
    }
}