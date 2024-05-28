<?php

namespace Alex\CodingTaskDataFeed\Http;

class Request
{
    private $method;
    private $uri;
    private $getData;
    private $postData;


    public function __construct($method, $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->getData=$_GET;
        $this->postData=$_POST;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    public function getIdentifier()
    {
        return "$this->method:$this->uri";
    }

    public function get(string $dataKey)
    {
        if ($this->method=='GET') {
            return $this->getData[$dataKey] ?? null;
        }
        if ($this->method=='POST') {
            return $this->postData[$dataKey] ?? null;

        }
        return null;
    }
}