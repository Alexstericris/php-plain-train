<?php

namespace Alex\CodingTaskDataFeed\Commands;


use Alex\CodingTaskDataFeed\Services\DataWriter\DataWriterInterface;
use Doctrine\DBAL\Types\Types;

class ImportCsv extends Command
{

    protected $parameters = ['csv'];
    /**
     * @var string[]
     */
    protected $options = ["--table=", "--filterCols="];
    protected $description = "This command imports csv files of the structure defined in imports config.\nUsage: ./bin/run.php import:csv <file.csv> --table=customtable --filterCols=id,col1";

    protected function getFilePathParameterKey(): string
    {
        return 'csv';
    }

    protected function parseFile(string $filePath): array
    {
        $csv = new \ParseCsv\Csv();
        $csv->auto($filePath);
        return $csv->data;
    }
}