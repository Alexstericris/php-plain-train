<?php

namespace Alex\CodingTaskDataFeed\Commands;


class ImportExcel extends Command
{
    protected $parameters = ['xlsx'];
    /**
     * @var string[]
     */
    protected $options = ["--table=", "--filterCols="];
    protected $description = "This command imports excel files of the structure defined in imports config.\nUsage: ./bin/run.php import:excel <file.xlsx> --table=customtable --filterCols=id,col1";


    public function handle(): int
    {
        if($this->option('--help')){
            $this->help();
            return 1;
        }

        $filePath = $this->parameter('xlsx');
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

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($completeFilePath);
        $worksheet = $spreadsheet->getActiveSheet();


        $tableOptions = config("imports.$table");
        $values = [];
        foreach ($tableOptions as $key => $option) {
            $values[$key] = '?';
        }
        $insertQuery = db()->insert($table);
        $insertQuery->values($values);
        $headers = [];
        foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
            if ($rowIndex === 1) {
                foreach ($row->getCellIterator() as $columnIndex => $cell) {
                    $headers[$columnIndex] = $cell->getValue();
                }
                continue;
            }

            foreach ($row->getCellIterator() as $columnIndex => $cell) {
                if (in_array($headers[$columnIndex],$colsFilter)) {
                    continue;
                }
                $itemValue = $this->typeCheckValue($cell->getValue(), $tableOptions[$headers[$columnIndex]]['type']);
                $insertQuery->setParameter(array_search($headers[$columnIndex], array_keys($values)), $itemValue);
            }
            $insertQuery->executeQuery();
            $insertQuery = db()->insert($table);
            $insertQuery->values($values);
        }

        return 0;
    }
}