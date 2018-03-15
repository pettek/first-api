<?php

namespace POlbrot\Router;

use POlbrot\Exceptions\URLNotMatchedException;

/**
 * Class Router
 *
 * @package POlbrot\Router
 */
class Router implements RouterInterface
{
    private $resolvers = [];

    /**
     * @param $uri
     * @return string
     */
    private static function addSlashToURI($uri): string
    {
        if($uri[\strlen($uri) - 1] !== '/') {
            $uri .= '/';
        }
        return $uri;
    }

    /**
     * @param RouteResolverInterface $routeResolver
     * @param int|null $priority
     *
     * @return Router
     */
    public function registerResolver(RouteResolverInterface $routeResolver, int $priority = null): Router
    {
        $priority = (int)$priority; // NULL -> 0
        $this->resolvers[$priority][] = $routeResolver;
        ksort($this->resolvers); // keep everything ordered by the key (priority)

        /*
         * Array of resolvers should be reversed, because indexes indicate priority and we want the resolvers with
         * higher priority to execute first, we don't care if array would be re-indexed as long as it preserves the
         * order i.e. array_reverse([2] => resolverOne [3] => resolverTwo)  =>  [0] => resolverTwo [1] => resolverOne
         */

        $this->resolvers = array_reverse($this->resolvers);

        return $this;
    }

    /**
     * @param string $uri
     *
     * @return null|RouteInterface
     * @throws URLNotMatchedException
     */
    public function resolve(string $uri): ?RouteInterface
    {
        /**
         * @var int $level
         * @var RouteResolverInterface[] $sameLevelResolvers
         */

        foreach ($this->resolvers as $level => $sameLevelResolvers) {
            foreach ($sameLevelResolvers as $resolver) {

                $uri = self::addSlashToURI($uri);
                $route = $resolver->resolve($uri);

                if ($route) {
                    return $route;
                }
            }
        }

        // Provided URI could not be resolved (it may be incorrect, resolvers were not registered etc.)
        throw new URLNotMatchedException();
    }

    /**
     * @return array
     */
    public function getResolvers(): array
    {
        return $this->resolvers;
    }

}