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

    /*
     * Properties: $firstNames, $lastNames, $passwords, $locations contain some random data in an array from to choose
     * randomly from
     */
    private $firstNames;
    private $lastNames;
    private $passwords;
    private $locations;

    /**
     * @return $this
     */
    private function init(): self
    {
        $this->user = new User();

        return $this;
    }

    /**
     * @return User
     */
    private function build(): User
    {
        return $this->user;
    }

    /**
     * @param DataProviderInterface $provider
     * @return UserBuilder
     */
    public function setFirstNames(DataProviderInterface $provider): UserBuilder
    {
        $this->firstNames = $provider->toArray();

        return $this;
    }

    /**
     * @param DataProviderInterface $provider
     * @return $this
     */
    public function setLastNames(DataProviderInterface $provider): self
    {
        $this->lastNames = $provider->toArray();

        return $this;
    }

    /**
     * @param DataProviderInterface $provider
     * @return $this
     */
    public function setPasswords(DataProviderInterface $provider): self
    {
        $this->passwords = $provider->toArray();

        return $this;
    }

    /**
     * @param DataProviderInterface $provider
     * @return $this
     */
    public function setLocations(DataProviderInterface $provider): self
    {
        $this->locations = $provider->toArray();

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomFirstName(): self
    {
        $firstName = Helpers::pickOneRandom($this->firstNames);

        $this->user->setFirstName($firstName);

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomLastName(): self
    {
        $lastName = Helpers::pickOneRandom($this->lastNames);

        $this->user->setLastName($lastName);

        return $this;
    }

    /**
     * @return $this
     */
    private function setUsername(): self
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
    private function setEmail(): self
    {
        $email = $this->user->getUsername() . '@fmail.com';

        $this->user->setEmail($email);

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomGender(): self
    {
        $gender = Helpers::pickOneRandom(['male', 'female']);

        $this->user->setGender($gender);

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomPassword(): self
    {
        $password = Helpers::pickRandomAlphanumeric();

        $this->user->setPassword(hash('sha512', $password . $this->user->getSalt()));

        return $this;
    }

    /**
     * Length: 22 was required by BCRYPT, not anymore, but left unchanged
     * @return $this
     */
    private function setRandomSalt(): self
    {
        $salt = Helpers::pickRandomAlphanumeric(22, 22);

        $this->user->setSalt($salt);

        return $this;
    }

    /**
     * @return $this
     */
    private function setRandomLocation(): self
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
    private function setDateOfBirth(): self
    {
        // Hard-coded boundaries
        $minAge = 10;
        $maxAge = 60;

        try {
            $daysOld = random_int($minAge * 365, $maxAge * 365); // pick random number of days

            /*
             * DateTime constructor accepts strings formatted as '-100 days' that will return a DateTime 100 days before
             * current timestamp
             */
            $dob = new DateTime('-' . $daysOld . 'days');

            $this->user->setDateOfBirth($dob);

            return $this;
        } catch (\Exception $e) {

            return $this;
        }

    }

    /**
     * @return $this
     */
    private function setTelephones(): self
    {
        /*
         * There are two hard-coded properties: private and work meaning the type of the telephone and also minimal
         * and maximal length of the telephone number string
         */

        $minTelephoneLength = 8;
        $maxTelephoneLength = 12;

        $private = (new Telephone())
            ->setType('private')
            ->setNumber(Helpers::pickRandomAlphanumeric($minTelephoneLength, $maxTelephoneLength, true));

        $work = (new Telephone())
            ->setType('work')
            ->setNumber(Helpers::pickRandomAlphanumeric($minTelephoneLength, $maxTelephoneLength, true));

        $this->user->addTelephone($private);
        $this->user->addTelephone($work);

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
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