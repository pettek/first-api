<?php

namespace POlbrot\HTTP;

/**
 * Class JSONResponse
 *
 * @package POlbrot\HTTP
 */
class JSONResponse extends Response
{
    /**
     * Accepts content that will be turned into the JSON object and adds an appropriate header
     *
     * @param $content
     */
    public function __construct($content = '')
    {
        parent::__construct(json_encode($content));
        $this->addHeader('Content-Type', 'application/json');
    }
}