<?php

namespace POlbrot\Application;

use POlbrot\HTTP\Request;
use POlbrot\HTTP\Response;
use POlbrot\Router\CustomRouteResolver;
use POlbrot\Router\Router;

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

        $class = $route->getControllerClass();
        $action = $route->getAction();

        $instance = new $class;
        $response = $instance->{$action}($request);

        return $response;
    }
}