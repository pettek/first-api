<?php

namespace POlbrot\Application;

use POlbrot\Helpers\Helpers;
use POlbrot\Router\CustomRouteResolver;
use POlbrot\Router\DefaultRouteResolver;
use POlbrot\Router\Router;
use POlbrot\Config\Config;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
            // Fetch JSON from application config and resolve routes from them
            $routes = Helpers::jsonFileToArray($this->config::get('custom-routes'));

            // Add some resolvers so the Router would work
            $router = (new Router())
                ->registerResolver(new DefaultRouteResolver(), 1)
                ->registerResolver(new CustomRouteResolver($routes), 2);

            // Resolve given URI --> If route is unresolved $router will throw an Exception
            $route = $router->resolve($request->server->get('REQUEST_URI'));

            // Extract significant data from returned Route
            $instance = $route->getController();
            $action = $route->getAction();
            $params = $route->getParams();

            // Make parameters available for the Controller via Request
            foreach ($params as $key => $value) {
                $request->attributes->set($key, $value);
            }

            // Get some response from the Controller
            return $instance->{$action}($request);

        } catch (\Exception $e) {

            // If anything went wrong in meantime, return an error response
            return new Response($e, Response::HTTP_NOT_FOUND);
        }
    }
}