<?php

namespace POlbrot\Router;

/**
 * Class Route
 *
 * @package POlbrot\Router
 */
class Route implements RouteInterface
{
    private $className;
    private $methodName;

    /**
     * Route constructor.
     *
     * @param $className
     * @param $methodName
     */
    public function __construct($className, $methodName)
    {
        $this->className = $className;
        $this->methodName = $methodName;
    }

    /**
     * @return string
     */
    public function getControllerClass(): string
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->methodName;
    }
}