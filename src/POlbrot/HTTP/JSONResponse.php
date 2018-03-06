<?php

namespace POlbrot\HTTP;

/**
 * Class JSONResponse
 *
 * @package POlbrot\HTTP
 */
class JSONResponse extends Response
{
    public function __construct()
    {
        $this->addHeader('Content-Type: application/json');
    }
}