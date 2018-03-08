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
        foreach ($this->resolvers as $level => $sameLevelResolvers) {
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