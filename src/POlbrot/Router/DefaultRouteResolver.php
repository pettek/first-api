<?php

namespace POlbrot\Router;

/**
 * Class DefaultRouteResolver
 *
 * @package POlbrot\Router
 */
class DefaultRouteResolver implements RouteResolverInterface
{
    const CONTROLLER_PATH = 'POlbrot\\Controller\\';
    const PARAMS_OFFSET = 3;

    /**
     * @param string $uri
     *
     * @return null|RouteInterface
     */
    public function resolve(string $uri): ?RouteInterface
    {
        $urlArray = explode('/', $uri);

        /**
         * If this is a valid URI it must have at least PARAMS_OFFSET (=3) elements after exploding it
         * Anything after 3rd element is a parameter
         */
        if (count($urlArray) >= self::PARAMS_OFFSET) {

            // First 3 are: empty, controller and method
            [, $controller, $method] = $urlArray;

            // And there is some remainder that may contain key-value pairs (parameters for method)
            $rest = array_slice($urlArray, self::PARAMS_OFFSET);

            // Decorate the name so they match controller and method name
            $controller = self::CONTROLLER_PATH.ucfirst($controller."Controller");
            $method = $method.'Action';
            $params = [];

            /*
             * Turn 1-dimensional array into associative array
             * ['a', 1, 'b', 2] = ['a' => 1, 'b' => 2]
             * ['a', 1, 'b'] = ['a' => 1]
             * If array has an odd number of elements, ignore the last one (every key has to have a value)
             */
            for ($paramIndex = 0; $paramIndex < (count($rest) - 1); $paramIndex++) {
                $params[$rest[$paramIndex++]] = $rest[$paramIndex]; // There is a tricky ++
            }

            if (class_exists($controller) && method_exists($controller, $method)) {

                return new Route($controller, $method, $params);
            } else {

                return null;
            }
        } else {

            return null;
        }

    }
}