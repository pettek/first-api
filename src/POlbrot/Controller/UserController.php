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
    public function getAction(Request $request)
    {
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

        return new JSONResponse($user);
    }
}