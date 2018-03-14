<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 12.03.2018
 * Time: 13:19
 */

namespace Tests\POlbrot\Router;

use POlbrot\Exceptions\InvalidJSONFileException;
use POlbrot\Exceptions\URLNotMatchedException;
use POlbrot\Router\CustomRouteResolver;
use POlbrot\Router\DefaultRouteResolver;
use POlbrot\Router\Router;
use PHPUnit\Framework\TestCase;
use POlbrot\Router\Route;

/**
 * Class RouterTest
 * @throws InvalidJSONFileException
 * @package Tests\POlbrot\Router
 */
class RouterTest extends TestCase
{
    public function testRegisterResolver(): void
    {
        $router = new Router();
        self::assertObjectHasAttribute('resolvers', $router);
        self::assertCount(0, $router->getResolvers());

        $router->registerResolver(new DefaultRouteResolver(), 1);
        self::assertCount(1, $router->getResolvers());

        $router->registerResolver(new DefaultRouteResolver(), 1);
        self::assertCount(1, $router->getResolvers());
        self::assertCount(2, $router->getResolvers()[1]);

        $router->registerResolver(new DefaultRouteResolver(), 2);
        self::assertCount(2, $router->getResolvers());
        self::assertCount(2, $router->getResolvers()[1]);
    }

    /**
     * @throws URLNotMatchedException
     */
    public function testResolve(): void
    {
        $router = new Router();
        $router->registerResolver(new DefaultRouteResolver(), 1);
        $router->registerResolver(new CustomRouteResolver([
            '/user/get/{number}/' => 'POlbrot\\Controller\\UserController::getAction'
        ]), 2);

        $route = $router->resolve('/user/get/3/');
        self::assertInstanceOf(Route::class, $route);
        self::assertEquals('getAction', $route->getAction());
        self::assertCount(1, $route->getParams());
        self::assertEquals('3', $route->getParams()['number']);

        $this->expectException(URLNotMatchedException::class);
        /** @noinspection PhpUnusedLocalVariableInspection */
        $route = $router->resolve('/not/existing/route');
    }
}
