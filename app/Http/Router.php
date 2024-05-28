<?php

namespace Alex\CodingTaskDataFeed\Http;

use Alex\CodingTaskDataFeed\Helpers\Arr;
use function PHPUnit\Framework\throwException;

class Router
{
    private $routes;

    public function __construct()
    {
        $rawRoutes = require __DIR__ . '/routes.php';
        $this->parseRoutes($rawRoutes);
    }

    private function parseRoutes($rawRoutes)
    {
        foreach ($rawRoutes as $route) {
            $this->routes[$route->getIdentifier()] = ['controller' => $route->getController(), 'action' => $route->getAction()];
        }
    }
    function handle(Request $request)
    {
        if (Arr::has($this->routes, $request->getIdentifier()) &&
            class_exists(Arr::get($this->routes, $request->getIdentifier() .'.controller'))) {
            $className = Arr::get($this->routes, $request->getIdentifier() .'.controller');
            $controller = new $className();
            $action = Arr::get($this->routes, $request->getIdentifier() . '.action');
            if (method_exists($className,$action)) {
                return $controller->$action($request);
            }
            throw new \Exception("The action $action doesn't exist in controller $className");
        }
    }
}