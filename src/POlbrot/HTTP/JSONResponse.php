<?php

namespace POlbrot\HTTP;

/**
 * Class JSONResponse
 *
 * @package POlbrot\HTTP
 */
class JSONResponse extends Response
{
    public $headers = ['Content-type: application/json'];
}