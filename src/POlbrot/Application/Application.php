<?php

namespace POlbrot\Application;

use POlbrot\HTTP\Request;
use POlbrot\Router\CustomRouteResolver;
use POlbrot\Router\Router;
use POlbrot\HTTP\Response;

/**
 * Interface ApplicationInterface
 */
class Application implements ApplicationInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $router = new Router();
        $router->registerResolver(new CustomRouteResolver());

        $route = $router->resolve($request->getUri());

        if ($route) {
            $class = $route->getControllerClass();
            $action = $route->getAction();

            $instance = new $class;
            $response = $instance->{$action}($request);

            return $response;
        } else {
            return new Response();
        }

    }
}