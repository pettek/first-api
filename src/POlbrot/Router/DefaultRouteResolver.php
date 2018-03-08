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
     * @param string $url
     *
     * @return null|RouteInterface
     */
    public function resolve(string $url): ?RouteInterface
    {
        $urlArray = explode('/', $url);
        if (count($urlArray) >= 3) {
            $controller = 'POlbrot\\Controller\\'.ucfirst($urlArray[1]."Controller");
            $method = $urlArray[2].'Action';

            if (class_exists($controller) && method_exists($controller, $method)) {
                return new Route($controller, $method);
            } else {
                return null;
            }
        } else {
            return null;
        }

    }
}