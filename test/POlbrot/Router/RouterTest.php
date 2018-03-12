<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 12.03.2018
 * Time: 13:19
 */

namespace Tests\POlbrot\Router;

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
        $this->assertObjectHasAttribute('resolvers', $router);
        $this->assertCount(0, $router->getResolvers());
    }

    public function testResolve()
    {
        $this->assertTrue(true);
    }
}
