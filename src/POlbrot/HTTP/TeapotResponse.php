<?php

namespace POlbrot\HTTP;

/**
 * Class NotFoundResponse
 *
 * @package POlbrot\HTTP
 */
class TeapotResponse extends Response
{
    /**
     * Accepts content that will be turned into the JSON object and adds an appropriate header
     *
     * @param $content
     */
    public function __construct($content = '')
    {
        parent::__construct(
            '<img src="https://orig00.deviantart.net/eaa7/f/2014/050/6/c/error_418_i_m_a_teapot_by_ai_15837-d7789z0.jpg" alt="teapot">'
        );
        $this->addHeader('HTTP/1.0 418 Not Found');

        return $this;
    }
}