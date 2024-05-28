<?php

namespace Alex\CodingTaskDataFeed\Http;

class Route
{
    private $method;
    private $uri;
    private $controller;
    private $action;
    public function __construct($method, $uri, $controller, $action)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getIdentifier()
    {
        return "$this->method:$this->uri";
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }
}