<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 13.03.2018
 * Time: 11:00
 */

use POlbrot\Model\UserBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Class UserBuilderTest
 */
class UserBuilderTest extends TestCase
{

    public function testGetUser()
    {
        $builder = new UserBuilder();
        $user = $builder->getUser();
        self::assertInstanceOf(\POlbrot\Model\User::class, $user);
        self::assertStringMatchesFormat('%S', $user->getFirstName());
        self::assertStringMatchesFormat('%S', $user->getLastName());
        self::assertStringMatchesFormat('%S', $user->getUsername());
        self::assertStringMatchesFormat('%S', $user->getPassword());
        self::assertStringMatchesFormat('%S', $user->getSalt());
        self::assertStringMatchesFormat('%S', $user->getEmail());
        self::assertStringMatchesFormat('%S', $user->getGender());
        self::assertInstanceOf(\POlbrot\Model\UserLocation::class, $user->getLocation());
        self::assertInstanceOf(DateTime::class, $user->getDateOfBirth());
        self::assertInternalType('array', $user->getTelephones());
    }
}
