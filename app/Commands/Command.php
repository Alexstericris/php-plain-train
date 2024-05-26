<?php

namespace Alex\CodingTaskDataFeed\Commands;
use Alex\CodingTaskDataFeed\Helpers\Arr;
use Doctrine\DBAL\Types\Types;

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
        if (in_array('--help',$this->arguments)) {
            return true;
        }
        foreach ($this->arguments as $argument) {
            if (str_contains($argument, $key)) {
                return str_replace($key, '', $argument);
            }
        }
        return $default;
    }

    protected function typeCheckValue($value, $type)
    {
        if ($type==Types::INTEGER) {
            $value=(int)$value;
        }
        if ($type==Types::FLOAT) {
            $value=(float)$value;
        }
        if ($type==Types::STRING||$type==Types::TEXT) {
            $value=is_array($value)?'':(string)$value;
        }
        if ($type==Types::BOOLEAN) {
            $value=(bool)$value;
        }
        return $value;
    }

    public function help(){
        echo $this->description;
    }

}