<?php

namespace POlbrot\Model;

use \DateTime;

/**
 * Class User
 */
class User implements \JsonSerializable
{
    private $firstName = '';
    private $lastName = '';
    private $username = '';
    private $password = '';
    private $salt = '';
    private $email = '';
    private $gender = '';
    private $location = null;
    private $dateOfBirth = null;
    private $telephones = [];


    public function __construct()
    {
        $this->location = new UserLocation();
        $this->dateOfBirth = new DateTime();
        $this->telephones = [];
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return null|UserLocation
     */
    public function getLocation(): ?UserLocation
    {
        return $this->location;
    }

    /**
     * @param UserLocation $location
     */
    public function setLocation(UserLocation $location): void
    {
        $this->location = $location;
    }

    /**
     * @return DateTime|null
     */
    public function getDateOfBirth(): ?DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @param DateTime $dateOfBirth
     */
    public function setDateOfBirth(DateTime $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return Telephone[]
     */
    public function getTelephones(): ?array
    {
        return $this->telephones;
    }

    /**
     * @param Telephone $telephone
     */
    public function addTelephone(Telephone $telephone): void
    {
        $this->telephones[] = $telephone;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'gender' => $this->getGender(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'salt' => $this->getSalt(),
            'location' => $this->getLocation(),
            'dateOfBirth' => $this->getDateOfBirth()->format('Y-m-d'),
            'telephones' => $this->getTelephones()
        ];
    }
}