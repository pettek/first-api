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
    /** @var string */
    private $controllerClass;

    /** @var string */
    private $action;

    /** @var array */
    private $params;

    /**
     * Route constructor.
     *
     * @param $controllerClass
     * @param $action
     * @param $params
     */
    public function __construct(string $controllerClass, string $action, array $params)
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