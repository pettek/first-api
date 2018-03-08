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
     * @return JSONResponse
     */
    public function getAction(Request $request): JSONResponse
    {

        // Temporary, so I don't get annoying messages :|
        if ($request) {
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
        }

        return new JSONResponse($user);
    }

    /**
     * @param Request $request
     *
     * @return JSONResponse
     */
    public function findAction(Request $request): JSONResponse
    {
        $params = $request->getParams();
        $age = $params['age'];
        $name = $params['name'];

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