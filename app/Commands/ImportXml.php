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
    protected $description = "This command imports xml files of the structure defined in imports config.";

    public function __construct(array $arguments)
    {
        parent::__construct($arguments);
    }

    public function handle(): int
    {
        $filePath = $this->parameter('xml');
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

        $xml = simplexml_load_file($completeFilePath);
        if ($xml == false) {
            throw new \Exception("Cannot create XML object from path $completeFilePath");
        }
        $itemsArray= json_decode(json_encode($xml), true);
        $tableOptions = config("imports.$table");
        $values = [];
        foreach ($tableOptions as $key => $option) {
            $values[$key] = '?';
        }
        $insertQuery = db()->insert($table);
        $insertQuery->values($values);
        foreach ($itemsArray as $itemGroup) {
            foreach ($itemGroup as $item){
                foreach ($item as $itemKey => $itemValue) {
                    $itemValue = $this->typeCheckValue($itemValue, $tableOptions[$itemKey]['type']);
                    $insertQuery->setParameter(array_search($itemKey, array_keys($values)), $itemValue);
                }
                $insertQuery->executeQuery();
                $insertQuery = db()->insert($table);
                $insertQuery->values($values);
            }
        }
        return 0;
    }

    private  function typeCheckValue($value,$type)
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

}