<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 13.03.2018
 * Time: 11:00
 */

namespace Tests\POlbrot\Model;

use DateTime;
use PHPUnit\Framework\TestCase;
use POlbrot\Model\User;
use POlbrot\Model\UserBuilderCreator;
use POlbrot\Model\UserLocation;

/**
 * Class UserBuilderTest
 */
class UserBuilderTest extends TestCase
{

    /**
     * @throws \POlbrot\Exceptions\InvalidJSONPathException
     * @throws \POlbrot\Exceptions\InvalidTextFilePathException
     * @throws \Exception
     */
    public function testGetUser()
    {
        $builder = UserBuilderCreator::get();
        $user = $builder->getUser();

        self::assertInstanceOf(User::class, $user);
        self::assertStringMatchesFormat('%s', $user->getFirstName());
        self::assertStringMatchesFormat('%s', $user->getLastName());
        self::assertStringMatchesFormat('%s', $user->getUsername());
        self::assertStringMatchesFormat('%s', $user->getPassword());
        self::assertStringMatchesFormat('%s', $user->getSalt());
        self::assertStringMatchesFormat('%s', $user->getEmail());
        self::assertStringMatchesFormat('%s', $user->getGender());
        self::assertInstanceOf(UserLocation::class, $user->getLocation());
        self::assertInstanceOf(DateTime::class, $user->getDateOfBirth());
        self::assertInternalType('array', $user->getTelephones());
    }
}
