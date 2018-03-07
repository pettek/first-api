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
     * Response constructor.
     *
     * @param $content
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addHeader($key, $value): void
    {
        $this->headers[$key] = $value;
    }

    public function sendHeaders(): void
    {
        foreach ($this->headers as $key => $value) {
            header($key.": ".$value);
        }
    }

    public function sendContent(): void
    {
        echo $this->content;
    }

    /**
     * @return ResponseInterface|void
     */
    public function send(): void
    {
        $this->sendHeaders();
        $this->sendContent();
    }
}