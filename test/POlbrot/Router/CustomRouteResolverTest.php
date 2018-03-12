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

/**
 * Class CustomRouteResolverTest
 * @package Tests\POlbrot\Router
 */
class CustomRouteResolverTest extends TestCase
{
    /**
     * @throws InvalidJSONFileException
     */
    public function testResolve()
    {
        $resolver = new CustomRouteResolver([
            '/api/' => 'POlbrot\\Controller\\UserController::getAction',
            '/api/users/{count}' => 'POlbrot\\Controller\\UserController::getAction',
        ]);

        $route = $resolver->resolve('/api/');
        self::assertInstanceOf('POlbrot\\Router\\Route', $route);
        self::assertInstanceOf('POlbrot\\Controller\\UserController', $route->getController());
        self::assertEquals('getAction', $route->getAction());
        self::assertCount(0, $route->getParams());

        $route = $resolver->resolve('/api/2');
        self::assertEquals(null, $route);

        $route = $resolver->resolve('/api/users/2');
        self::assertInstanceOf('POlbrot\\Router\\Route', $route);
        self::assertInstanceOf('POlbrot\\Controller\\UserController', $route->getController());
        self::assertEquals('getAction', $route->getAction());
        self::assertArrayHasKey('count', $route->getParams());
        self::assertEquals('2', $route->getParams()['count']);
        self::assertCount(1, $route->getParams());

        $resolver = new CustomRouteResolver([
            '/api/{count}/{name}/' => 'POlbrot\\Controller\\UserController::getAction',
            '/api/users/get/{count}/' => 'POlbrot\\Controller\\UserController::fetchAction'
        ], ['acceptEmptyParams' => true]);

        $route = $resolver->resolve('/api/4//');
        self::assertInstanceOf('POlbrot\\Router\\Route', $route);
        self::assertInstanceOf('POlbrot\\Controller\\UserController', $route->getController());
        self::assertEquals('getAction', $route->getAction());
        self::assertArrayHasKey('count', $route->getParams());
        self::assertArrayHasKey('name', $route->getParams());
        self::assertEquals('4', $route->getParams()['count']);
        self::assertEquals('', $route->getParams()['name']);
        self::assertCount(2, $route->getParams());

        self::expectException(InvalidJSONFileException::class);
        $route = $resolver->resolve('/api/users/get/3/');
    }
}
