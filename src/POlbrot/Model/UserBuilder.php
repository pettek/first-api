<?php

namespace POlbrot\Model;

use POlbrot\DataProvider\DataProviderInterface;
use POlbrot\DataProvider\JSONDataProvider;
use POlbrot\Exceptions\InvalidJSONFileException;
use POlbrot\Exceptions\InvalidJSONPathException;

/**
 * Class UserBuilder
 */
class UserBuilder
{
    /**
     * @var User $user
     */
    private $user;
    private $firstNames;
    private $lastNames;

    /**
     * @param $arr
     * @return mixed
     */
    private static function pickOneRandom($arr)
    {
        return $arr[array_rand($arr)];
    }

    /**
     * @return $this
     */
    private function init()
    {
        $this->user = new User();

        return $this;
    }

    /**
     * @return User
     */
    private function build()
    {
        return $this->user;
    }

    /**
     * @param DataProviderInterface $provider
     * @return UserBuilder
     */
    public function setFirstNames(DataProviderInterface $provider)
    {
        $this->firstNames = $provider->toArray();

        return $this;
    }

    /**
     * @param DataProviderInterface $provider
     * @return $this
     */
    public function setLastNames(DataProviderInterface $provider)
    {
        $this->lastNames = $provider->toArray();

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        $this->init();
        $this->user->setFirstName(self::pickOneRandom($this->firstNames));
        $this->user->setLastName(self::pickOneRandom($this->lastNames));
        return $this->build();
    }
}