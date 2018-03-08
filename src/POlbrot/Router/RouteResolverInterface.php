<?php

namespace POlbrot\Router;

use POlbrot\HTTP\Request;

/**
 * Interface RouteResolverInterface
 */
interface RouteResolverInterface
{
    /**
     * Resolves url string, returning RouteInterface object
     *
     * @param Request $request
     *
     * @return RouteInterface|null
     */
    public function resolve(Request $request): ?RouteInterface;
}