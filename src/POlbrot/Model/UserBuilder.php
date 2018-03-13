<?php

namespace POlbrot\Model;

use POlbrot\DataProvider\DataProviderInterface;
use POlbrot\Helpers\Helpers;

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
     * @return $this
     */
    private function setRandomFirstName()
    {
        $firstName = Helpers::pickOneRandom($this->firstNames);

        $this->user->setFirstName($firstName);

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomLastName()
    {
        $lastName = Helpers::pickOneRandom($this->lastNames);

        $this->user->setLastName($lastName);

        return $this;
    }

    /**
     * @return $this
     */
    private function setUsername()
    {
        $username = strtolower($this->user->getFirstName()[0] . $this->user->getLastName());

        $this->user->setUsername($username);

        return $this;
    }

    /**
     * @return $this
     */
    private function setEmail()
    {
        $email = $this->user->getUsername() . '@fmail.com';

        $this->user->setEmail($email);

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomGender()
    {
        $gender = Helpers::pickOneRandom(['male', 'female']);

        $this->user->setGender($gender);

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomPassword()
    {
        $password = Helpers::pickRandomAlphanumeric(6, 12);

        $this->user->setPassword($password);

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomSalt()
    {
        $salt = Helpers::pickRandomAlphanumeric();

        $this->user->setSalt($salt);

        return $this;
    }
    /**
     * @return User
     */
    public function getUser()
    {
        return $this->init()
            ->setRandomFirstName()
            ->setRandomLastName()
            ->setUsername()
            ->setEmail()
            ->setRandomGender()
            ->setRandomPassword()
            ->setRandomSalt()
            ->build();
    }
}