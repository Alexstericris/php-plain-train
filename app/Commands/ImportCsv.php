<?php

namespace Alex\CodingTaskDataFeed\Commands;


use Doctrine\DBAL\Types\Types;

class ImportCsv extends Command
{

    protected $parameters = ['csv'];
    /**
     * @var string[]
     */
    protected $options = ["--table=", "--filterCols="];
    protected $description = "This command imports csv files of the structure defined in imports config.\nUsage: ./bin/run.php import:csv <file.csv> --table=customtable --filterCols=id,col1";


    public function handle(): int
    {
        if($this->option('--help')){
            $this->help();
            return 1;
        }

        $filePath = $this->parameter('csv');
        if($filePath==null)
            throw new \Exception("File path not specified");

        $parsedPath = pathinfo($filePath);
        if (strlen($parsedPath['dirname'])>2) {
            $completeFilePath = $filePath;
        }else{
            $completeFilePath = project_root_path() . $parsedPath['basename'];
        }

        $table=$this->option('--table=','feedxml');
        if (!schema()->tableExists($table)) {
            throw new \Exception("Table '$table' does not exist yet. \nYou can define a structure in config/imports.php and create a new migration in database/migrations");
        }

        $colsFilter = $this->option('--filter=', 'id');
        $colsFilter = explode(',', $colsFilter);

        $csv = new \ParseCsv\Csv();
        $csv->auto($completeFilePath);

        $tableOptions = config("imports.$table");
        $values = [];
        foreach ($tableOptions as $key => $option) {
            $values[$key] = '?';
        }
        $insertQuery = db()->insert($table);
        $insertQuery->values($values);
        foreach ($csv->data as $row) {
            foreach ($row as $itemKey => $itemValue) {
                if (in_array($itemKey,$colsFilter)) {
                    continue;
                }
                $itemValue = $this->typeCheckValue($itemValue, $tableOptions[$itemKey]['type']);
                $insertQuery->setParameter(array_search($itemKey, array_keys($values)), $itemValue);
            }
            $insertQuery->executeQuery();
            $insertQuery = db()->insert($table);
            $insertQuery->values($values);
        }

        return 0;
    }


}