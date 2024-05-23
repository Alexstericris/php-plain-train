<?php

namespace Alex\CodingTaskDataFeed\Commands;
use Alex\CodingTaskDataFeed\Helpers\Arr;

abstract class Command
{
    protected $parameters;
    protected $options;
    protected $description;
    protected $arguments;

    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }

    abstract protected function handle(): int;

    public function parameter($key)
    {
        $parameterIndex = array_search($key, $this->parameters);
        if ($parameterIndex !== false && Arr::has($this->arguments, $parameterIndex)) {
            return $this->arguments[$parameterIndex];
        }
        return null;
    }

    public function option($key,$default = null)
    {
        foreach ($this->arguments as $argument) {
            if (str_contains($argument, $key)) {
                return str_replace($key, '', $argument);
            }
        }
        return $default;
    }

}