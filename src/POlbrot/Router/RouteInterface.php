<?php

namespace POlbrot\Router;

use POlbrot\Controller\Controller;

/**
 * Interface RouteInterface
 */
interface RouteInterface
{
    /**
     * Returns fully qualified controller name
     *
     * @return Controller
     */
    public function getController(): Controller;

    /**
     * Returns action name
     *
     * @return string
     */
    public function getAction(): string;

    /**
     * Returns an array of route parameters
     *
     * @return array
     */
    public function getParams(): array;
}