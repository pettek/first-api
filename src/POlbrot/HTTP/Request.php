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

    /**
     * Request constructor.
     *
     * @param $uri
     * @param $get
     * @param $post
     */
    private function __construct($uri, $get, $post)
    {
        $this->uri = $uri;
        $this->get = $get;
        $this->post = $post;
    }

    /**
     * @return Request
     */
    public static function createFromGlobals()
    {
        return new Request($_SERVER['REQUEST_URI'], $_GET, $_POST);
    }
}