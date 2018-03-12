<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 12.03.2018
 * Time: 13:19
 */

namespace Tests\POlbrot\Router;

use POlbrot\Router\DefaultRouteResolver;
use POlbrot\Router\Router;
use PHPUnit\Framework\TestCase;

/**
 * Class RouterTest
 * @package Tests\POlbrot\Router
 */
class RouterTest extends TestCase
{

    public function testRegisterResolver()
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

    public function testResolve()
    {
        self::assertTrue(true);
    }
}
