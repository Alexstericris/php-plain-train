<?php

namespace Alex\CodingTaskDataFeed\Commands;
use Alex\CodingTaskDataFeed\Helpers\Arr;
use Alex\CodingTaskDataFeed\Services\DataWriter\DataWriterInterface;
use Doctrine\DBAL\Types\Types;

abstract class Command
{
    protected $parameters;
    protected $options;
    protected $description;
    protected $arguments;

    public function __construct(protected DataWriterInterface $dataWriter){}

    abstract protected function getFilePathParameterKey(): string;
    abstract protected function parseFile(string $filePath): array;

    public function handle($arguments): int
    {
        $this->arguments = $arguments;
        if ($this->option('--help')) {
            $this->help();
            return 1;
        }

        $filePath = $this->parameter($this->getFilePathParameterKey());
        if ($filePath == null) {
            throw new \Exception("File path not specified");
        }
        $completeFilePath = $this->getCompleteFilePath($filePath);

        $table = $this->option('--table=', 'feedxml');
        if (!schema()->tableExists($table)) {
            throw new \Exception("Table '$table' does not exist yet. Define a structure in config/imports.php and create a new migration in database/migrations");
        }

        $colsFilter = $this->option('--filter=', 'id');
        $colsFilter = explode(',', $colsFilter);

        $data = $this->parseFile($completeFilePath);

        $tableOptions = config("imports.$table");
        $this->dataWriter->insertData($data, $tableOptions, $table, $colsFilter);

        return 0;
    }

    protected function getCompleteFilePath(string $filePath): string
    {
        $parsedPath = pathinfo($filePath);
        if (strlen($parsedPath['dirname']) > 2) {
            return $filePath;
        } else {
            return project_root_path() . $parsedPath['basename'];
        }
    }

    public function parameter($key)
    {
        $parameterIndex = array_search($key, $this->parameters);
        if ($parameterIndex !== false && Arr::has($this->arguments, $parameterIndex)) {
            return $this->arguments[$parameterIndex];
        }
        return null;
    }

    public function option($key, $default = null)
    {
        if (in_array('--help', $this->arguments)) {
            return true;
        }
        foreach ($this->arguments as $argument) {
            if (str_contains($argument, $key)) {
                return str_replace($key, '', $argument);
            }
        }
        return $default;
    }

    public function help()
    {
        echo $this->description;
    }

}