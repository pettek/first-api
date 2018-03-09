<?php

namespace POlbrot\Router;

use POlbrot\HTTP\Request;

/**
 * Class Router
 *
 * @package POlbrot\Router
 */
class Router implements RouterInterface
{
    private $resolvers = [];

    /**
     * @param RouteResolverInterface $routeResolver
     * @param int|null               $priority
     *
     * @return Router
     */
    public function registerResolver(RouteResolverInterface $routeResolver, int $priority = null)
    {
        $priority = intval($priority); // NULL -> 0
        $this->resolvers[$priority][] = $routeResolver;

        return $this;
    }

    /**
     * @param Request $request
     *
     * @return null|RouteInterface
     */
    public function resolve(Request $request): ?RouteInterface
    {
        /**
         * @var int                      $level
         * @var RouteResolverInterface[] $sameLevelResolvers
         */

        /*
         * Array of resolvers should be reversed, because indexes indicate priority and we want the resolvers with
         * higher priority to execute first, we don't care if array would be re-indexed as long as it preserves the
         * order i.e. array_reverse([2] => resolverOne [3] => resolverTwo)  =>  [0] => resolverTwo [1] => resolverOne
         */
        $resolvers = array_reverse($this->resolvers);

        foreach ($resolvers as $level => $sameLevelResolvers) {
            foreach ($sameLevelResolvers as $resolver) {
                $route = $resolver->resolve($request);

                if ($route) {
                    return $route;
                }
            }
        }

        return null;
    }

}