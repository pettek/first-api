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
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function sendHeaders()
    {
        foreach ($this->headers as $key => $value) {
            header($key.": ".$value);
        }
    }

    public function sendContent()
    {
        echo $this->content;
    }

    /**
     * @return ResponseInterface|void
     */
    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();
    }
}