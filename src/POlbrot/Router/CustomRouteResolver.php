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
     * CustomRouteResolver constructor.
     */
    public function __construct($relativePath)
    {
        $this->routes = json_decode(
            file_get_contents(__DIR__ . '\\' . $relativePath),
            true
        );

        foreach($this->routes as $key => $value) {
            $key = str_replace('{', '(?P<', $key);
            $key = str_replace('}', '>.+)', $key);
            $key = str_replace('/', '\/', $key);
            $key = '/'.$key.'$/';
            $this->regexRoutes[$key] = $value;
        }
    }

    /**
     * @param string $url
     *
     * @return null|RouteInterface
     */
    public function resolve(Request $request): ?RouteInterface
    {
        $classMethodString = null;
        foreach($this->regexRoutes as $route => $classMethod) {
            $matches = [];
            if(preg_match($route, $request->getUri(), $matches) === 1){
                $classMethodString = $classMethod;

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