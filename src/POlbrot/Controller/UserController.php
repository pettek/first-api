<?php

namespace POlbrot\Controller;

use POlbrot\HTTP\JSONResponse;
use POlbrot\HTTP\Request;

/**
 * Class UserController
 *
 * @package POlbrot\Controller
 */
class UserController
{
    /**
     * Returns instance of JSONResponse with some fake user data as content
     *
     * @param Request $request
     *
     * @param array   $params
     *
     * @return JSONResponse
     */
    public function getAction(Request $request, Array $params = []): JSONResponse
    {

        $users = [];
        $howManyToGenerate = $params['number'] ?? 1;

        for ($i = 0; $i < $howManyToGenerate; $i++) {
            $user = [
                'name' => [
                    'first' => 'Imie',
                    'last' => 'Nazwisko',
                ],
                'location' => 'Wroclaw',
                'user' => [
                    'username' => [
                        'login' => 'inazwisko99',
                        'email' => 'inazwisko@gmail.com',
                    ],
                    'password' => '9879a98ba78a9ba',
                ],
            ];
            array_push($users, $user);
        }

        return new JSONResponse($users);
    }

    /**
     * @param Request $request
     *
     * @param array   $params
     *
     * @return JSONResponse
     */
    public function findAction(Request $request, Array $params = []): JSONResponse
    {
        $age = $params['age'] ?? 'defaultAge';
        $name = $params['name'] ?? 'defaultName';

        $user = [
            'name' => [
                'first' => $name,
                'last' => 'Nazwisko',
            ],
            'location' => 'Wroclaw',
            'age' => $age,
        ];

        return new JSONResponse($user);
    }
}