<?php

namespace POlbrot\Model;

use DateTime;
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
    private $passwords;
    private $locations;

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
     * @param DataProviderInterface $provider
     * @return $this
     */
    public function setPasswords(DataProviderInterface $provider)
    {
        $this->passwords = $provider->toArray();

        return $this;
    }

    /**
     * @param DataProviderInterface $provider
     * @return $this
     */
    public function setLocations(DataProviderInterface $provider)
    {
        $this->locations = $provider->toArray();

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
        $username = Helpers::createRandomUsername(
            $this->user->getFirstName(),
            $this->user->getLastName()
        );

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
        $password = Helpers::pickRandomAlphanumeric();

        $this->user->setPassword(hash('sha512', $password . $this->user->getSalt()));

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomSalt()
    {
        $salt = Helpers::pickRandomAlphanumeric(22, 22);

        $this->user->setSalt($salt);

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomLocation()
    {
        $location = Helpers::pickOneRandom($this->locations);

        $this->user->setLocation(
            (new UserLocation())
                ->setCountry($location['country'])
                ->setCity($location['city'])
                ->setStreet($location['street'])
                ->setZipCode($location['zipCode'])
        );

        return $this;
    }

    /**
     * @return $this
     */
    private function setDateOfBirth()
    {
        $daysOld = mt_rand(10 * 365, 60 * 365);
        $dob = new DateTime('-' . $daysOld . 'days');

        $this->user->setDateOfBirth($dob);

        return $this;
    }

    private function setTelephones()
    {
        $private = (new Telephone())
            ->setType('private')
            ->setNumber(Helpers::pickRandomAlphanumeric(8,12, true));
        $work = (new Telephone())
            ->setType('work')
            ->setNumber(Helpers::pickRandomAlphanumeric(8,12, true));

        $this->user->addTelephone($private);
        $this->user->addTelephone($work);

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
            ->setRandomSalt()
            ->setRandomPassword()
            ->setRandomLocation()
            ->setDateOfBirth()
            ->setTelephones()
            ->build();
    }
}