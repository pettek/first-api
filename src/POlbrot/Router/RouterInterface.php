<?php

namespace POlbrot\Router;

/**
 * Interface RouterInterface
 */
interface RouterInterface
{
    /**
     * @param RouteResolverInterface $routeResolver
     * @param int|null               $priority
     */
    public function registerResolver(RouteResolverInterface $routeResolver, int $priority = null);

    /**
     * @param string $url
     *
     * @return RouteInterface|null
     */
    public function resolve(string $url): ?RouteInterface;
}