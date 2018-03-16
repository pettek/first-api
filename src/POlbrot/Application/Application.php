<?php

namespace POlbrot\Application;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use POlbrot\Helpers\Helpers;
use POlbrot\Router\CustomRouteResolver;
use POlbrot\Router\DefaultRouteResolver;
use POlbrot\Router\Route;
use POlbrot\Router\Router;
use POlbrot\Config\Config;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface ApplicationInterface
 */
class Application implements ApplicationInterface
{
    /** @var null|Config */
    private $config;

    /** @var EntityManager */
    private $entityManager;

    /**
     * Application constructor.
     * Requires a Config object that contains some configuration info
     * (Right now only the path to JSON containing custom routes)
     *
     * @param Config|null $config
     * @throws \Doctrine\ORM\ORMException
     */
    public function __construct(Config $config = null)
    {
        $this->config = $config;
        $this->entityManager = $this->entityManager ?: $this->initEntityManager();
    }

    /**
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    private function initEntityManager(): EntityManager
    {
        $isDevMode = true;
        $path = dirname(__DIR__, 2);
        $config = Setup::createAnnotationMetadataConfiguration([$path], $isDevMode);

        // database configuration parameters
        $conn = [
            'driver' => 'pdo_sqlite',
            'path' => dirname(__DIR__, 3) . '\\db.sqlite',
        ];

        // obtaining the entity manager
        return EntityManager::create($conn, $config);
    }

    /**
     * Accepts a Request and returns a Response, there will always be a Response, even if Request is somehow invalid or
     * simply not handled by the application. May throw a InvalidArgumentException, because there is a Response created
     * via constructor in catch block, if the status provided is incorrect.
     *
     * @param Request $request
     *
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function handle(Request $request): Response
    {
        try {
            // Fetch JSON from application config and resolve routes from it
            $routes = Helpers::jsonFileToArray($this->config::get('custom-routes'));

            /*
             * Add some resolvers so the Router would work; higher priorities will be checked first, so the lower ones
             * provide fallback
             */
            $router = (new Router())
                ->registerResolver(new DefaultRouteResolver(), 1)
                ->registerResolver(new CustomRouteResolver($routes), 2);

            // Resolve given URI --> If route is unresolved $router will throw an Exception
            $route = $router->resolve($request->server->get('REQUEST_URI'));

            // Extract significant data from returned Route
            if ($route instanceof Route) {
                $instance = $route->getController()->setApplication($this);
                $action = $route->getAction();
                $params = $route->getParams();

                // Make parameters available for the Controller via Request
                foreach ($params as $key => $value) {
                    $request->attributes->set($key, $value);
                }

                // Get some response from the Controller
                $response = $instance->{$action}($request);
            } else {

                $response = new Response('', Response::HTTP_NOT_FOUND);

            }
        } catch (\Exception $e) {

            // If anything went wrong in meantime, return an error response
            $response = new Response($e, Response::HTTP_NOT_FOUND);
        }

        // Add a header to enable Cross-Origin Resource Sharing
        return self::onBeforeSend($response);

    }

    /**
     * Adds a proper header to enable Cross-Origin Resource Sharing
     *
     * @param Response $response
     * @return Response
     */
    private static function onBeforeSend(Response $response): Response
    {
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}