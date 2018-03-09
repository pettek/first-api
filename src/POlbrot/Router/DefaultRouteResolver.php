<?php

namespace POlbrot\Router;

/**
 * Class DefaultRouteResolver
 *
 * @package POlbrot\Router
 */
class DefaultRouteResolver implements RouteResolverInterface
{
    /**
     * @param string $uri
     *
     * @todo Add params
     * @return null|RouteInterface
     */
    public function resolve(string $uri): ?RouteInterface
    {
        $urlArray = explode('/', $uri);
        if (count($urlArray) >= 3) {
            $controller = 'POlbrot\\Controller\\'.ucfirst($urlArray[1]."Controller");
            $method = $urlArray[2].'Action';

            if (class_exists($controller) && method_exists($controller, $method)) {
                return new Route($controller, $method, []);
            } else {
                return null;
            }
        } else {
            return null;
        }

    }
}