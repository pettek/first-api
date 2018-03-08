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
     */
    public function registerResolver(RouteResolverInterface $routeResolver, int $priority = null)
    {
        $priority = ($priority === NULL) ? 3 : $priority;
        $this->resolvers[$priority][] = $routeResolver;
    }

    /**
     * @param string $url
     *
     * @return null|RouteInterface
     */
    public function resolve(string $url): ?RouteInterface
    {
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