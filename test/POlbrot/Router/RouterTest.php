<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 12.03.2018
 * Time: 13:19
 */

namespace Tests\POlbrot\Router;

use PHPUnit\Framework\MockObject\MockObject;
use POlbrot\Controller\UserController;
use POlbrot\Exceptions\InvalidJSONFileException;
use POlbrot\Exceptions\URLNotMatchedException;
use POlbrot\Router\CustomRouteResolver;
use POlbrot\Router\DefaultRouteResolver;
use POlbrot\Router\Router;
use PHPUnit\Framework\TestCase;
use POlbrot\Router\Route;
use POlbrot\Router\RouterInterface;

/**
 * Class RouterTest
 * @throws InvalidJSONFileException
 * @package Tests\POlbrot\Router
 */
class RouterTest extends TestCase
{
    protected $router;

    protected function setUp()
    {
        $this->router = new Router();
    }

    /**
     * @test
     */
    public function shouldAddResolverNoMatterPriority(): void
    {
        /**
         * @var RouterInterface|Router $router
         */
        $router = $this->router;

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
     * @test
     * @throws \ReflectionException
     */
    public function shouldTakePriorityIntoAccount(): void
    {
        /** @var RouterInterface $router */
        $router = $this->router;

        /** @var DefaultRouteResolver|MockObject $defaultStub */
        $defaultStub = $this->createMock(DefaultRouteResolver::class);
        $defaultStub->method('resolve')->willReturn(
            new Route(UserController::class, 'getAction', [])
        );

        /** @var CustomRouteResolver|MockObject $customStub */
        $customStub = $this->createMock(DefaultRouteResolver::class);
        $customStub->method('resolve')->willReturn(
            new Route(UserController::class, 'getAction', ['number' => '3'])
        );

        $router->registerResolver($defaultStub, 1);
        $router->registerResolver($customStub, 2);

        $route = $router->resolve('/user/get/3/');
        self::assertInstanceOf(Route::class, $route);
        self::assertEquals('getAction', $route->getAction());
        self::assertCount(1, $route->getParams());
        self::assertEquals('3', $route->getParams()['number']);
    }

    /**
 * @test
 * @throws \ReflectionException
 */
    public function shouldReturnNullIfCannotResolve(): void
    {
        /** @var RouterInterface $router */
        $router = $this->router;

        /** @var CustomRouteResolver|MockObject $customStub */
        $customStub = $this->createMock(DefaultRouteResolver::class);
        $customStub->method('resolve')->willReturn(
            new Route(UserController::class, 'getAction', ['number' => '3'])
        );

        $this->expectException(URLNotMatchedException::class);
        $router->resolve('/any/url/possible');
    }
}
