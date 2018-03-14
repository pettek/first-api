<?php
/**
 * Created by PhpStorm.
 * User: POlbrot
 * Date: 13.03.2018
 * Time: 11:00
 */

namespace Tests\POlbrot\Model;

use DateTime;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use POlbrot\DataProvider\DataProviderInterface;
use POlbrot\DataProvider\JSONDataProvider;
use POlbrot\Model\User;
use POlbrot\Model\UserBuilder;
use POlbrot\Model\UserLocation;

/**
 * Class UserBuilderTest
 */
class UserBuilderTest extends TestCase
{

    /**
     * @test
     * @throws \Exception
     */
    public function shouldCreateUser(): User
    {
        /** @var DataProviderInterface|MockObject $firstNameProvider */
        $firstNameProvider = $this->createMock(JSONDataProvider::class);
        $firstNameProvider->method('toArray')->willReturn(['Name']);

        /** @var DataProviderInterface|MockObject $lastNameProvider */
        $lastNameProvider = $this->createMock(JSONDataProvider::class);
        $lastNameProvider->method('toArray')->willReturn(['LastName']);

        /** @var DataProviderInterface|MockObject $locationProvider */
        $locationProvider = $this->createMock(JSONDataProvider::class);
        $locationProvider
            ->method('toArray')
            ->willReturn([
                ['country' => 'Poland',
                'city' => 'Wroclaw',
                'street' => 'Wyscigowa',
                'zipCode' => '51-000']
            ]);


        $builder = new UserBuilder();
        $builder->setFirstNames($firstNameProvider);
        $builder->setLastNames($lastNameProvider);
        $builder->setLocations($locationProvider);

        $user = $builder->getUser();

        self::assertInstanceOf(User::class, $user);

        return $user;
    }

    /**
     * @test
     * @depends shouldCreateUser
     * @param $user
     */
    public function shouldCreateNonEmptyUserFields($user): void
    {
        /** @var User $user */

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
