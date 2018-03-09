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
     * @param $params
     */
    public function __construct($controllerClass, $action, $params)
    {
        $this->controllerClass = $controllerClass;
        $this->action = $action;
        $this->params = $params;
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