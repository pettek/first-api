<?php

namespace POlbrot\Model;

/**
 * Class UserLocation
 */
class UserLocation {
    private $country = '';
    private $city = '';
    private $street = '';
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
}