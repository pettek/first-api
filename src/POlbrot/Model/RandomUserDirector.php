<?php

namespace POlbrot\Model;

/**
 * Class RandomUserDirector
 *
 * @package POlbrot\Model
 */
class RandomUserDirector
{
    private $genders = ['male', 'female'];

    private $maleFirstNames = ['Kamil', 'Krzysztof', 'Kryspin'];
    private $femaleFirstNames = ['Iza', 'Iga', 'Paulina'];

    private $maleLastNames = ['Wojcik', 'Kowalski', 'Nowak'];
    private $femaleLastNames = ['Kowalska', 'Nowakowska', 'Lewandowska'];

    private $cities = ['Wroclaw', 'Krakow', 'Warszawa'];
    private $streets = ['Wyscigowa', 'Tenisowa', 'Slezna'];

    private $builder;
    /**
     * RandomUserDirector constructor.
     *
     * @param UserBuilder $builder
     */
    public function __construct(UserBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return User
     */
    public function get() {
        $gender = $this->genders[array_rand($this->genders)];

        $firstName = ($gender === 'male') ?
            $this->maleFirstNames[array_rand($this->maleFirstNames)] :
            $this->femaleFirstNames[array_rand($this->femaleFirstNames)];

        $lastName = ($gender === 'male') ?
            $this->maleLastNames[array_rand($this->maleLastNames)] :
            $this->femaleLastNames[array_rand($this->femaleLastNames)];

        $phone = rand(1000000, 99999999);
        $city = array_rand($this->cities);
        $street = array_rand($this->streets);
        $email = strtolower($firstName[0].$lastName.'@gmail.com');

        return $this->builder
            ->create()
            ->setGender($gender)
            ->setName($firstName, $lastName)
            ->setLocation($this->cities[$city], $this->streets[$street])
            ->setEmail($email)
            ->setPhone($phone)
            ->build();
    }
}

