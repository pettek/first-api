<?php

namespace POlbrot\Application;

use POlbrot\HTTP\Request;
use POlbrot\HTTP\Response;

/**
 * Interface ApplicationInterface
 */
class Application implements ApplicationInterface
{
    /**
     * @param \POlbrot\HTTP\Request $request
     *
     * @return \POlbrot\HTTP\Response
     */
    public function handle(Request $request)
    {
        $response = new Response();

        if ($request->uri === '/api') {
            array_push($response->headers, 'Content-type: application/json');

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
            $response->content = json_encode($user);
        }

        return $response;
    }
}