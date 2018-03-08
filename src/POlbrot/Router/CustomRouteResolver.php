<?php

namespace POlbrot\Router;

/**
 * Class CustomRouteResolver
 *
 * @package POlbrot\Router
 */
class CustomRouteResolver implements RouteResolverInterface
{
    private $routes;

    /**
     * CustomRouteResolver constructor.
     */
    public function __construct()
    {
        $this->routes = json_decode(
            file_get_contents(__DIR__.'\custom_routes.json'),
            true
        );
    }

    /**
     * @param string $url
     *
     * @return null|RouteInterface
     */
    public function resolve(string $url): ?RouteInterface
    {
        $classMethodString = $this->routes[$url] ?? null;

        if ($classMethodString) {
            list($className, $methodName) = explode('::', $classMethodString);

            return new Route($className, $methodName);
        }

        return null;
    }
}