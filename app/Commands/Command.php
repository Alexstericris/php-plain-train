<?php

namespace Alex\CodingTaskDataFeed\Commands;
abstract class Command
{
    protected $argvTemplate;
    protected $description;
    protected $arguments;

    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }

    abstract protected function handle(): int;

    public function option($key)
    {

    }

}