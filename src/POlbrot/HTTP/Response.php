<?php

namespace POlbrot\HTTP;

/**
 * Class Response
 */
class Response implements ResponseInterface
{
    protected $headers = [];
    protected $content;

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param $newHeader
     */
    public function addHeader($newHeader)
    {
        array_push($this->headers, $newHeader);
    }

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