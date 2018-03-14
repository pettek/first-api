<?php

namespace POlbrot\Router;

use POlbrot\Exceptions\InvalidJSONFileException;

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
    private function createRegexRoutes(): void
    {
        $this->regexRoutes = [];
        foreach ($this->routes as $key => $value) {
            $key = htmlspecialchars($key); // replace some potentially dangerous chars with HTML entities
            $key = str_replace('/', '\/', $key); // escape every slash
            /** @noinspection CascadeStringReplacementInspection */
            $key = str_replace('{', '(?<', $key); // convert { to beginning of named match in regex
            /*
             * If acceptEmptyParams === true this -> /some/path/param1//param2/90 will produce param1 = '', param2 = 90
             * Otherwise it will not match the url
             */
            if ($this->acceptEmptyParams) {
                $key = str_replace('}', '>[^\/]*)', $key); // convert } to end of named match
            } else {
                $key = str_replace('}', '>[^\/]+)', $key); // convert } to end of named match
            }
            $key = '/^' . $key . '$/'; // end the regex here, nothing after that

            $this->regexRoutes[$key] = $value;
        }
    }

    /**
     * CustomRouteResolver constructor.
     *
     * @param array $routes
     * @param array $configData
     */
    public function __construct(array $routes = [], array $configData = [])
    {
        $this->routes = $routes;
        $this->acceptEmptyParams = $configData['acceptEmptyParams'] ?? false;
        $this->createRegexRoutes();
    }

    /**
     * @param string $uri
     *
     * @return null|RouteInterface
     * @throws InvalidJSONFileException
     */
    public function resolve(string $uri): ?RouteInterface
    {
        $classMethodString = null;
        $matches = [];

        foreach ($this->regexRoutes as $regexRoute => $classMethod) {
            if (preg_match($regexRoute, $uri, $matches) === 1) {
                $classMethodString = $classMethod;
                break;
            }
        }

        if ($classMethodString) {
            [$className, $methodName] = explode('::', $classMethodString);
            if (!class_exists($className) || !method_exists($className, $methodName)) {
                throw new InvalidJSONFileException();
            }
            $filteredMatches = array_filter($matches, function ($key) {
                return !\is_int($key);
            }, ARRAY_FILTER_USE_KEY);

            return new Route($className, $methodName, $filteredMatches);
        }

        return null;
    }
}