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

    /**
     * Returns an array of route parameters
     *
     * @return array
     */
    public function getParams(): array;
}