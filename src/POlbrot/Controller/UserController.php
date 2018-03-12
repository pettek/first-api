<?php

namespace POlbrot\Controller;

use POlbrot\HTTP\JSONResponse;
use POlbrot\HTTP\Request;
use POlbrot\Model\RandomUserDirector;
use POlbrot\Model\UserBuilder;

/**
 * Class UserController
 *
 * @package POlbrot\Controller
 */
class UserController extends Controller
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

        $users = [];
        $howManyToGenerate = $request->params->getValue('number') ?? 1;

        for ($i = 0; $i < $howManyToGenerate; $i++) {
            $director = new RandomUserDirector(new UserBuilder());
            $user = $director->get();

            $users[] = (array) $user;
        }

        return new JSONResponse($users);
    }

    /**
     * @param Request $request
     *
     * @return JSONResponse
     */
    public function findAction(Request $request): JSONResponse
    {
        $age = $request->params->getValue('age') ?? 'defaultAge';
        $name = $request->params->getValue('name') ?? 'defaultName';

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