<?php

namespace POlbrot\Router;

/**
 * Class CustomRouteResolver
 *
 * @package POlbrot\Router
 */
class CustomRouteResolver implements RouteResolverInterface
{
    private $routes;
    private $regexRoutes;
    private $acceptEmptyParams = false;

    /**
     * Create regexPattern routes from routes
     */
    private function createRegexRoutes()
    {
        foreach ($this->routes as $key => $value) {
            $key = htmlspecialchars($key); // replace some potentially dangerous chars with HTML entities
            $key = str_replace('/', '\/', $key); // escape every slash
            $key = str_replace('{', '(?<', $key); // convert { to beginning of named match in regex
            /*
             * If acceptEmptyParams === true this -> /some/path/param1//param2/90 will produce param1 = '', param2 = 90
             * Otherwise it will not match the url
             */
            if($this->acceptEmptyParams){
                $key = str_replace('}', '>[^\/]*)', $key); // convert } to end of named match
            } else {
                $key = str_replace('}', '>[^\/]+)', $key); // convert } to end of named match
            }
            $key = '/'.$key.'\B/'; // end the regex here, nothing after that

            $this->regexRoutes[$key] = $value;
        }
    }

    /**
     * CustomRouteResolver constructor.
     *
     * @param array $routes
     * @param array $configData
     */
    public function __construct(Array $routes, Array $configData = [])
    {
        $this->routes = $routes;
        $this->acceptEmptyParams = ($configData['acceptEmptyParams']) ?? false;
        $this->createRegexRoutes();
    }

    /**
     * @param string $uri
     *
     * @return null|RouteInterface
     */
    public function resolve(string $uri): ?RouteInterface
    {
        $classMethodString = null;
        foreach ($this->regexRoutes as $regexRoute => $classMethod) {
            $matches = [];
            if (preg_match($regexRoute, $uri, $matches) === 1) {
                $classMethodString = $classMethod;
                break;
            }
        }

        if ($classMethodString) {
            list($className, $methodName) = explode('::', $classMethodString);

            return new Route($className, $methodName, $matches);
        }

        return null;
    }
}