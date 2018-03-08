<?php

namespace POlbrot\Router;
/**
 * Interface RouteInterface
 */
interface RouteInterface
{
    /**
     * Returns fully qualified controller name
     *
     * @return string
     */
    public function getControllerClass(): string;

    /**
     * Returns action name
     *
     * @return string
     */
    public function getAction(): string;
}