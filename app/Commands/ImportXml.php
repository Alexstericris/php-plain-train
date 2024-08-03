<?php
namespace Alex\CodingTaskDataFeed\Commands;
use Doctrine\DBAL\Types\Types;

class ImportXml extends Command
{

    /**
     * @var string[]
     */
    protected $parameters = ['xml'];
    /**
     * @var string[]
     */
    protected $options = ["--table="];

    protected $description = "This command imports xml files of the structure defined in imports config.\nUsage: ./bin/run.php import:xml <file.xml> --table=customtable";


    protected function getFilePathParameterKey(): string
    {
        return 'xml';
    }

    protected function parseFile(string $filePath): array
    {
        $xml = simplexml_load_file($filePath);
        if ($xml == false) {
            throw new \Exception("Cannot create XML object from path $filePath");
        }
        $itemsArray= json_decode(json_encode($xml), true);
        return $itemsArray['item'];
    }

}