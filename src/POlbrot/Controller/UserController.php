<?php

namespace POlbrot\Controller;

use POlbrot\Model\UserBuilderCreator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
     * @return JsonResponse
     * @throws \POlbrot\Exceptions\InvalidJSONPathException
     * @throws \POlbrot\Exceptions\InvalidTextFilePathException
     * @throws \Exception
     */
    public function getAction(Request $request): JsonResponse
    {

        $users = [];
        $howManyToGenerate = $request->attributes->get('number') ?? 1;

        $builder = UserBuilderCreator::get();

        for ($i = 0; $i < $howManyToGenerate; $i++) {
            $user = $builder->getUser();

            $users[] = $user;
        }

        return new JsonResponse($users);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function findAction(Request $request): JsonResponse
    {
        $age = $request->attributes->get('age') ?? 'defaultAge';
        $name = $request->attributes->get('name') ?? 'defaultName';

        $user = [
            'name' => [
                'first' => $name,
                'last' => 'Nazwisko',
            ],
            'location' => 'Wroclaw',
            'age' => $age,
        ];

        return new JsonResponse($user);
    }
}