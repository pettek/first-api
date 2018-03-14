<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 12.03.2018
 * Time: 16:21
 */

namespace Tests\POlbrot\Router;

use POlbrot\Router\DefaultRouteResolver;
use PHPUnit\Framework\TestCase;
use POlbrot\Router\Route;

/**
 * Class DefaultRouteResolverTest
 * @package Tests\POlbrot\Router
 */
class DefaultRouteResolverTest extends TestCase
{

    public function testResolve(): void
    {
        $resolver = new DefaultRouteResolver();
        $route = $resolver->resolve('/user/get');
        self::assertInstanceOf(Route::class, $route);
        self::assertEquals('getAction', $route->getAction());
        self::assertCount(0, $route->getParams());

        $route = $resolver->resolve('/user/create');
        self::assertEquals(null, $route);

        $route = $resolver->resolve('/');
        self::assertEquals(null, $route);

        $route = $resolver->resolve('/user/get/param/value/');
        self::assertInstanceOf(Route::class, $route);
        self::assertEquals('getAction', $route->getAction());
        self::assertCount(1, $route->getParams());
        self::assertEquals('value', $route->getParams()['param']);
    }
}
