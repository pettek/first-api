<?php

namespace POlbrot\Model;

/**
 * Class UserBuilder
 */
class UserBuilder
{
    private $user;

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
     * @return User
     */
    public function getUser()
    {
        return $this->init()->build();
    }
}