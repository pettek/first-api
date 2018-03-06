<?php

namespace POlbrot\HTTP;

/**
 * Class Response
 */
class Response implements ResponseInterface
{

    public $headers = [];

    public $content;

    /**
     * @return ResponseInterface|void
     */
    public function send()
    {
        foreach ($this->headers as $header) {
            header($header);
        }

        echo $this->content;
    }
}