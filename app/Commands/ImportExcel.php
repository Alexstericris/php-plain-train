<?php

namespace Alex\CodingTaskDataFeed\Commands;


use Alex\CodingTaskDataFeed\Services\DataWriter\DataWriterInterface;

class ImportExcel extends Command
{
    protected $parameters = ['xlsx'];
    /**
     * @var string[]
     */
    protected $options = ["--table=", "--filterCols="];
    protected $description = "This command imports excel files of the structure defined in imports config.\nUsage: ./bin/run.php import:excel <file.xlsx> --table=customtable --filterCols=id,col1";

    protected function getFilePathParameterKey(): string
    {
        return 'xlsx';
    }

    protected function parseFile(string $filePath): array
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];
        $headers = [];

        foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $columnIndex => $cell) {
                if ($rowIndex === 1) {
                    $headers[$columnIndex] = $cell->getValue();
                } else {
                    $rowData[$headers[$columnIndex]] = $cell->getValue();
                }
            }
            if ($rowIndex > 1) {
                $data[] = $rowData;
            }
        }
        return $data;
    }
}