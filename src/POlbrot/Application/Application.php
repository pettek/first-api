<?php

namespace POlbrot\Application;

use POlbrot\HTTP\Request;
use POlbrot\HTTP\JSONResponse;
use POlbrot\HTTP\Response;

/**
 * Interface ApplicationInterface
 */
class Application implements ApplicationInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        if ($request->getUri() === '/api') {
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
            $response = new JSONResponse($user);
        } else {
            $response = (new Response())->addHeader('Location', '/api');
        }

        return $response;
    }
}