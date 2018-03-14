<?php

namespace POlbrot\Router;

use POlbrot\Controller\Controller;

/**
 * Class Route
 *
 * @package POlbrot\Router
 */
class Route implements RouteInterface
{
    private $controllerClass;
    private $action;
    private $params;

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

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return new $this->controllerClass;
    }
}