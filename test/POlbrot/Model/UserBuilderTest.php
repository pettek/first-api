<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 13.03.2018
 * Time: 11:00
 */

use PHPUnit\Framework\TestCase;
use POlbrot\Model\UserBuilderCreator;

/**
 * Class UserBuilderTest
 */
class UserBuilderTest extends TestCase
{

    /**
     * @throws \POlbrot\Exceptions\InvalidJSONPathException
     * @throws \POlbrot\Exceptions\InvalidTextFilePathException
     */
    public function testGetUser()
    {
        $builder = UserBuilderCreator::get();
        $user = $builder->getUser();

        self::assertInstanceOf(\POlbrot\Model\User::class, $user);
        self::assertStringMatchesFormat('%s', $user->getFirstName());
        self::assertStringMatchesFormat('%s', $user->getLastName());
        self::assertStringMatchesFormat('%s', $user->getUsername());
        self::assertStringMatchesFormat('%s', $user->getPassword());
        self::assertStringMatchesFormat('%s', $user->getSalt());
        self::assertStringMatchesFormat('%s', $user->getEmail());
        self::assertStringMatchesFormat('%s', $user->getGender());
        self::assertInstanceOf(\POlbrot\Model\UserLocation::class, $user->getLocation());
        self::assertInstanceOf(DateTime::class, $user->getDateOfBirth());
        self::assertInternalType('array', $user->getTelephones());
    }
}
