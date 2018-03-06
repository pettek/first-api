<?php

namespace POlbrot;

/**
 * Class API
 *
 * @package POlbrot
 */
class API
{
    /**
     * @return string
     */
    static public function index()
    {
        $user = [
            'name' => [
                'first' => 'Imie',
                'last' => 'Nazwisko'
            ],
            'location' => 'Wroclaw',
            'user' => [
                'username' => [
                    'login' => 'inazwisko99',
                    'email' => 'inazwisko@gmail.com'
                ],
                'password' => '9879a98ba78a9ba'
            ]
        ];

        return json_encode($user);
    }
}