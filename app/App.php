<?php

namespace Alex\CodingTaskDataFeed;

use Alex\CodingTaskDataFeed\Http\Request;
use Alex\CodingTaskDataFeed\Http\Router;

class App
{
    private Router $router;
    public function __construct()
    {
    }

    function registerRouter(Router $router)
    {
        $this->router = $router;
    }

    function handle(Request $request)
    {
        return $this->router->handle($request);
    }
}