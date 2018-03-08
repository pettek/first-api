<?php

namespace POlbrot\Router;

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
     * @param string $url
     *
     * @return null|RouteInterface
     */
    public function resolve(string $url): ?RouteInterface
    {
        /**
         * @var int                      $level
         * @var RouteResolverInterface[] $sameLevelResolvers
         */
        foreach ($this->resolvers as $level => $sameLevelResolvers) {
            foreach ($sameLevelResolvers as $resolver) {
                $route = $resolver->resolve($url);

                if ($route) {
                    return $route;
                }
            }
        }

        return null;
    }

}