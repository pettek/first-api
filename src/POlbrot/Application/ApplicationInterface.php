<?php

namespace POlbrot\Application;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface ApplicationInterface
 */
interface ApplicationInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request): Response;

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager;
}