<?php

namespace POlbrot\Router;

/**
 * Interface RouteResolverInterface
 */
interface RouteResolverInterface
{
    /**
     * Resolves url string, returning RouteInterface object
     *
     * @param string $url
     *
     * @return RouteInterface|null
     */
    public function resolve(string $url): ?RouteInterface;
}