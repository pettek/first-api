<?php

namespace POlbrot\Router;

/**
 * Class Route
 *
 * @package POlbrot\Router
 */
class Route implements RouteInterface
{
    private $controllerClass;
    private $action;
    private $params = [];

    /**
     * Route constructor.
     *
     * @param $controllerClass
     * @param $action
     */
    public function __construct($controllerClass, $action)
    {
        $this->controllerClass = $controllerClass;
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getControllerClass(): string
    {
        return $this->controllerClass;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams(): array
    {
        return $this->params;
    }
}