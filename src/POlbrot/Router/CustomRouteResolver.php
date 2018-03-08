<?php

namespace POlbrot\Router;

use POlbrot\HTTP\Request;

/**
 * Class CustomRouteResolver
 *
 * @package POlbrot\Router
 */
class CustomRouteResolver implements RouteResolverInterface
{
    private $routes;
    private $regexRoutes;

    /**
     * Create regexPattern routes from routes
     */
    private function createRegexRoutes()
    {
        foreach ($this->routes as $key => $value) {
            $key = str_replace('/', '\/', $key);
            $key = str_replace('{', '(?P<', $key);
            $key = str_replace('}', '>.+)', $key);
            $key = '/'.$key.'$/';

            $this->regexRoutes[$key] = $value;
        }
    }

    /**
     * CustomRouteResolver constructor.
     *
     * @param $relativePath
     */
    public function __construct($relativePath)
    {
        $this->routes = json_decode(
            file_get_contents(__DIR__.'\\'.'custom_routes.json'),
            true
        );
        $this->createRegexRoutes();
    }

    /**
     * @param Request $request
     *
     * @return null|RouteInterface
     */
    public function resolve(Request $request): ?RouteInterface
    {
        $classMethodString = null;
        foreach ($this->regexRoutes as $route => $classMethod) {
            $matches = [];
            if (preg_match($route, $request->getUri(), $matches) === 1) {
                $classMethodString = $classMethod;
                $request->setParams($matches);
                break;
            }
        }

        if ($classMethodString) {
            list($className, $methodName) = explode('::', $classMethodString);

            return new Route($className, $methodName);
        }

        return null;
    }
}