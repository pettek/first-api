<?php

namespace POlbrot\Router;

use POlbrot\HTTP\Request;

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
     * @param Request $request
     *
     * @return RouteInterface|null
     */
    public function resolve(Request $request): ?RouteInterface;
}