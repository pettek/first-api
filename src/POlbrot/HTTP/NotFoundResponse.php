<?php

namespace POlbrot\HTTP;

/**
 * Class NotFoundResponse
 *
 * @package POlbrot\HTTP
 */
class NotFoundResponse extends Response
{
    /**
     * Accepts content that will be turned into the JSON object and adds an appropriate header
     *
     * @param $content
     */
    public function __construct($content = '')
    {
        parent::__construct($content);
        $this->addHeader('HTTP/1.0 404 Not Found');
    }
}