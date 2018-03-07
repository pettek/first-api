<?php

namespace POlbrot\Application;

use POlbrot\Controller\UserController;
use POlbrot\HTTP\Request;
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
            $response = (new UserController())->getAction($request);
        } else {
            $response = new Response('Some text');
        }

        return $response;
    }
}