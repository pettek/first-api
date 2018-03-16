<?php

namespace POlbrot\Controller;

use POlbrot\Application\Application;

/**
 * Class Controller
 * This is the place for methods and properties that will be shared by all the controllers in the future
 *
 * @package POlbrot\Router
 */
class Controller
{
    /** @var Application */
    protected $application;

    /**
     * @return mixed
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param mixed $application
     * @return Controller
     */
    public function setApplication($application): Controller
    {
        $this->application = $application;

        return $this;
    }


}