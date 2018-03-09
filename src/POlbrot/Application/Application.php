<?php

namespace POlbrot\Application;

use POlbrot\Helpers\Helpers;
use POlbrot\HTTP\Request;
use POlbrot\HTTP\Response;
use POlbrot\HTTP\TeapotResponse;
use POlbrot\Router\CustomRouteResolver;
use POlbrot\Router\DefaultRouteResolver;
use POlbrot\Router\Router;
use POlbrot\Config\Config;

/**
 * Interface ApplicationInterface
 */
class Application implements ApplicationInterface
{
    private $config;

    /**
     * Application constructor.
     *
     * @param Config|null $config
     */
    public function __construct(Config $config = null)
    {
        $this->config = $config;
    }

    /**
     * Accepts a Request and returns a Response, there will always be a Response, even if Request is somehow invalid or
     * simply not handled by the application
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $routes = Helpers::JsonFileToArray($this->config::get('custom-routes'));

        $router = (new Router())
            ->registerResolver(new DefaultRouteResolver(), 1)
            ->registerResolver(new CustomRouteResolver($routes), 2);

        $route = $router->resolve($request->getUri());

        // If route is unresolved $route will contain null value
        if ($route) {
            // There is a correct controller and action, use them

            $class = $route->getControllerClass();
            $action = $route->getAction();
            $params = $route->getParams();

            $instance = new $class;
            $response = $instance->{$action}($request, $params);

            return $response;
        } else {
            // Provided URI could not be resolved (it may be incorrect, resolvers were not registered etc.)

            return new TeapotResponse();
        }

    }
}