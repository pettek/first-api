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
     * @todo REFACTOR THIS, THIS LOOKS BAD
     * @return null|RouteInterface
     */
    public function resolve(string $uri): ?RouteInterface
    {
        $urlArray = explode('/', $uri);
        if (count($urlArray) >= 3) {
            $controller = 'POlbrot\\Controller\\'.ucfirst($urlArray[1]."Controller");
            $method = $urlArray[2].'Action';
            $params = [];

            $howManyParams = intval((count($urlArray) - 3) / 2);
            for($paramIndex = 0; $paramIndex < $howManyParams; $paramIndex++){
                $params[$urlArray[3 + 2 * $paramIndex]] = $urlArray[4 + 2 * $paramIndex];
            }

            if (class_exists($controller) && method_exists($controller, $method)) {
                return new Route($controller, $method, $params);
            } else {
                return null;
            }
        } else {
            return null;
        }

    }
}