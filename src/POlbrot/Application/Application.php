<?php

namespace POlbrot\Application;

use POlbrot\Exceptions\URLNotMatchedException;
use POlbrot\Helpers\Helpers;
use POlbrot\HTTP\Request;
use POlbrot\HTTP\Response;
use POlbrot\HTTP\NotFoundResponse;
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
    public function __construct(Config $config)
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
        try {
            $routes = Helpers::jsonFileToArray($this->config::get('custom-routes'));

            $router = (new Router())
                ->registerResolver(new DefaultRouteResolver(), 5)
                ->registerResolver(new CustomRouteResolver($routes), 1);

            $route = $router->resolve($request->getUri());

            // If route is unresolved $route will contain null value
            if ($route) {
                // There is a correct controller and action, use them

                $instance = $route->getController();
                $action = $route->getAction();
                $params = $route->getParams();

                foreach($params as $key => $value)
                {
                    $request->params->setValue($key, $value);
                }

                return $instance->{$action}($request);
            }
            // Provided URI could not be resolved (it may be incorrect, resolvers were not registered etc.)
            throw new URLNotMatchedException();

        } catch (\Exception $e) {

            return new NotFoundResponse($e);
        }
    }
}