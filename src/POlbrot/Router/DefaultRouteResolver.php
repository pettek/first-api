<?php

namespace POlbrot\Router;

use POlbrot\HTTP\Request;


/**
 * Class DefaultRouteResolver
 *
 * @package POlbrot\Router
 */
class DefaultRouteResolver implements RouteResolverInterface
{
    /**
     * @param Request $request
     *
     * @return null|RouteInterface
     */
    public function resolve(Request $request): ?RouteInterface
    {
        $urlArray = explode('/', $request->getUri());
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