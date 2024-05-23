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

    function run(array $arguments): int
    {
        if (!key_exists(1, $arguments) || $arguments[1] == '--help') {
            $this->help();
            return 1;
        }

        $command = $arguments[1];

        log_info("Running command $command");
        if (!key_exists($command, $this->commands)) {
            echo "The command $command doesn't exist or is not registered.\n";
            log_error("The command $command doesn't exist or is not registered.");
            $this->help();
            return 1;
        }
        try {
            $status = (new $this->commands[$command](array_slice($arguments, 2, sizeof($arguments))))->handle();
            return $status;
        } catch (\Exception $exception) {
            echo $exception->getMessage() . "\n";
            log_error($exception->getMessage());
            return 1;
        }
    }

    function help(): void
    {
        echo "Available commands:\n";
        foreach ($this->commands as $command => $handler) {
            echo "  $command\n";
        }
        echo "\nUsage: ./bin/run.php <command> [parameters] [arguments]\n";
    }
}