<?php

namespace POlbrot\Model;

/**
 * Class represents a UserLocation
 * It implements JsonSerializable method to show private properties in the API
 */
class UserLocation implements \JsonSerializable
{
    /** @var string  */
    private $country = '';

    /** @var string  */
    private $city = '';

    /** @var string  */
    private $street = '';

    /** @var string  */
    private $zipCode = '';

    /**
     * @return mixed
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @return UserLocation
     */
    public function setCountry($country): UserLocation
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return UserLocation
     */
    public function setCity($city): UserLocation
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     * @return UserLocation
     */
    public function setStreet($street): UserLocation
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     * @return UserLocation
     */
    public function setZipCode($zipCode): UserLocation
    {
        $this->zipCode = $zipCode;

        return $this;
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
            'country' => $this->getCountry(),
            'city' => $this->getCity(),
            'zipCode' => $this->getZipCode(),
            'street' => $this->getStreet(),
        ];
    }
}