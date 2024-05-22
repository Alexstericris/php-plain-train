<?php
namespace Alex\CodingTaskDataFeed;

use Alex\CodingTaskDataFeed\Commands\ImportCsv;
use Alex\CodingTaskDataFeed\Commands\ImportExcel;
use Alex\CodingTaskDataFeed\Commands\ImportXml;

class Console
{
    private $commands=[
        'import:xml'=>ImportXml::class,
        'import:csv'=>ImportCsv::class,
        'import:excel'=>ImportExcel::class
    ];

    function run(array $arguments)
    {
        if (!key_exists(1,$arguments)) {
            $this->help();
            return 1;
        }
        $command = $arguments[1];
        if (!key_exists($command, $this->commands)) {
            echo "The command $command doesn't exist or is not registered.\n";
            $this->help();
            return 1;
        }
        try {
            $status = (new $this->commands[$command](array_slice($arguments, 2, sizeof($arguments))))->handle();
            return $status;
        } catch (\Exception $exception) {
            echo $exception->getMessage() . "\n";
            return 1;
        }
    }

    function help()
    {

    }
}