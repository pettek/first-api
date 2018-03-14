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
use POlbrot\Router\RouteResolverInterface;

/**
 * Class DefaultRouteResolverTest
 * @package Tests\POlbrot\Router
 */
class DefaultRouteResolverTest extends TestCase
{

    /** @var RouteResolverInterface $resolver */
    protected $resolver;

    protected function setUp()
    {
        $this->resolver = new DefaultRouteResolver();
    }

    /**
     * @test
     */
    public function shouldReturnRouteWithoutParamsOnMatch(): void
    {
        $route = $this->resolver->resolve('/user/get');
        self::assertInstanceOf(Route::class, $route);
        self::assertEquals('getAction', $route->getAction());
        self::assertCount(0, $route->getParams());
    }

    /**
     * @test
     */
    public function shouldReturnNullOnIncorrectMethod(): void
    {
        $route = $this->resolver->resolve('/user/create');
        self::assertEquals(null, $route);
    }

    /**
     * @test
     */
    public function shouldReturnNullOnRootURI(): void
    {
        $route = $this->resolver->resolve('/');
        self::assertEquals(null, $route);
    }

    /**
     * @test
     */
    public function shouldReturnRouteWithParamsOnMatch(): void
    {
        $route = $this->resolver->resolve('/user/get/param/value/');
        self::assertInstanceOf(Route::class, $route);
        self::assertEquals('getAction', $route->getAction());
        self::assertCount(1, $route->getParams());
        self::assertEquals('value', $route->getParams()['param']);
    }
}
