<?php

namespace POlbrot\Controller;

use POlbrot\Entity\User;
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
     * Depends on data from files (via UserBuilderCreator::get) so it may throw exceptions indicating that data file
     * cannot be read (does not exist or is not valid)
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws \POlbrot\Exceptions\InvalidJSONPathException
     * @throws \POlbrot\Exceptions\InvalidTextFilePathException
     */
    public function getAction(Request $request): JsonResponse
    {
        $users = [];

        // Show one user if not specified in request attribute
        $howManyToGenerate = $request->attributes->get('number') ?? 1;

        // Get instance of builder already filled with data from datafiles
        $builder = UserBuilderCreator::get();

        // Fill $users array with some random data
        for ($i = 0; $i < $howManyToGenerate; $i++) {
            $user = $builder->getUser();

            $users[] = $user;
        }

        return new JsonResponse($users);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \POlbrot\Exceptions\InvalidJSONPathException
     * @throws \POlbrot\Exceptions\InvalidTextFilePathException
     * @throws \Doctrine\ORM\ORMException
     */
    public function createAction(Request $request): JsonResponse
    {
        $howManyUsersToAdd = 1000;
        $users = [];
        $builder = UserBuilderCreator::get();

        for($index = 0; $index < $howManyUsersToAdd; $index++) {
            $users[] = $builder->getUser();
        }

        $startTime = microtime(true);
        $em = $this->application->getEntityManager();
        $em->beginTransaction();

        foreach($users as $randomUser) {
            $user = new User();

            $user->setFirstName($randomUser->getFirstName());
            $user->setLastName($randomUser->getLastName());
            $user->setUsername($randomUser->getUsername());
            $user->setPassword($randomUser->getPassword());


            $em->persist($user);
        }

        $em->commit();
        $em->flush();

        $endTime = microtime(true);
        $timeElapsedInSeconds = ($endTime - $startTime);

        return new JsonResponse(['time', $timeElapsedInSeconds]);
    }
}