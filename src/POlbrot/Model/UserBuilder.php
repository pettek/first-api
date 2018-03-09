<?php

namespace POlbrot\Model;

/**
 * Class UserBuilder
 *
 * @package POlbrot\Model
 */
class UserBuilder {

    /**
     * @var User $user
     */
    private $user;

    /**
     * @return UserBuilder
     */
    public function create()
    {
        $this->user = new User();

        return $this;
    }

    /**
     * @param $first
     * @param $last
     *
     * @return UserBuilder
     */
    public function setName($first, $last)
    {
        $this->user->setName([
            'first' => $first,
            'last' => $last
        ]);

        return $this;
    }

    /**
     * @param $gender
     *
     * @return UserBuilder
     */
    public function setGender($gender)
    {
        $this->user->setGender($gender);

        return $this;
    }

    /**
     * @param $city
     * @param $street
     *
     * @return UserBuilder
     */
    public function setLocation($city, $street)
    {
        $this->user->setLocation([
            'city' => $city,
            'street' => $street
        ]);

        return $this;
    }

    /**
     * @param $email
     *
     * @return UserBuilder
     */
    public function setEmail($email)
    {
        $this->user->setEmail($email);

        return $this;
    }

    /**
     * @param $phone
     *
     * @return UserBuilder
     */
    public function setPhone($phone)
    {
        $this->user->setPhone($phone);

        return $this;
    }

    /**
     * @return User
     */
    public function build()
    {
        return $this->user;
    }
}