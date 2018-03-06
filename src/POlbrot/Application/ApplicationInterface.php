<?php

namespace POlbrot\Application;

use POlbrot\HTTP\Request;

/**
 * Interface ApplicationInterface
 */
interface ApplicationInterface
{
    /**
     * @param \POlbrot\HTTP\Request $request
     *
     * @return \POlbrot\HTTP\Response
     */
    public function handle(Request $request);
}