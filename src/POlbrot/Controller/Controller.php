<?php

namespace POlbrot\Controller;

use POlbrot\Application\Application;

/**
 * Class Controller
 * This is the place for methods and properties that will be shared by all the controllers
 *
 * @package POlbrot\Router
 */
class Controller
{
    /** @var Application */
    protected $application;

    /**
     * @return Application|null
     */
    public function getApplication(): ?Application
    {
        return $this->application;
    }

    /**
     * @param Application
     * @return Controller
     */
    public function setApplication($application): Controller
    {
        $this->application = $application;

        return $this;
    }


}