<?php

namespace POlbrot\HTTP;

/**
 * Interface ResponseInterface
 */
interface ResponseInterface
{
    /**
     * @return ResponseInterface
     */
    public function send();
}