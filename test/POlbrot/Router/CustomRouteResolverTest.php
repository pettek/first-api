<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 12.03.2018
 * Time: 14:11
 */

namespace Tests\POlbrot\Router;

use POlbrot\Exceptions\InvalidJSONFileException;
use POlbrot\Router\CustomRouteResolver;
use PHPUnit\Framework\TestCase;
use POlbrot\Router\Route;
use POlbrot\Router\RouteResolverInterface;

/**
 * Class CustomRouteResolverTest
 * @package Tests\POlbrot\Router
 */
class CustomRouteResolverTest extends TestCase
{
    /** @var RouteResolverInterface $correctResolver */
    protected $correctResolver;

    /** @var RouteResolverInterface $flawedResolver */
    protected $flawedResolver;

    protected function setUp()
    {
        $this->correctResolver = new CustomRouteResolver([
            '/api/' => 'POlbrot\\Controller\\UserController::getAction',
            '/api/users/{count}' => 'POlbrot\\Controller\\UserController::getAction',
        ]);

        $this->flawedResolver = new CustomRouteResolver([
            '/api/{count}/{name}/' => 'POlbrot\\Controller\\UserController::getAction',
            '/api/users/get/{count}/' => 'POlbrot\\Controller\\UserController::fetchAction'
        ], ['acceptEmptyParams' => true]);
    }

    /**
     * @test
     */
    public function shouldReturnRouteOnMatch(): void
    {
        $route = $this->correctResolver->resolve('/api/');
        self::assertInstanceOf(Route::class, $route);
        self::assertEquals('getAction', $route->getAction());
        self::assertCount(0, $route->getParams());
    }

    /**
     * @test
     */
    public function shouldReturnNullOnNoMatch(): void
    {
        $route = $this->correctResolver->resolve('/api/2');
        self::assertEquals(null, $route);
    }

    /**
     * @test
     */
    public function shouldReturnRouteWithParamsOnRegexMatch(): void
    {
        $route = $this->correctResolver->resolve('/api/users/2');
        self::assertInstanceOf(Route::class, $route);
        self::assertEquals('getAction', $route->getAction());
        self::assertArrayHasKey('count', $route->getParams());
        self::assertEquals('2', $route->getParams()['count']);
        self::assertCount(1, $route->getParams());
    }

    /**
     * @test
     */
    public function shouldReturnRouteWithEmptyParamIfSpecified(): void
    {
        $route = $this->flawedResolver->resolve('/api/4//');
        self::assertInstanceOf(Route::class, $route);
        self::assertEquals('getAction', $route->getAction());
        self::assertArrayHasKey('count', $route->getParams());
        self::assertArrayHasKey('name', $route->getParams());
        self::assertEquals('4', $route->getParams()['count']);
        self::assertEquals('', $route->getParams()['name']);
        self::assertCount(2, $route->getParams());
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfIncorrectMethod(): void
    {
        $this->expectException(InvalidJSONFileException::class);
        $this->flawedResolver->resolve('/api/users/get/3/');
    }

}
