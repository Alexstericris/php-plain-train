<?php

namespace Alex\CodingTaskDataFeed\Services;

use Alex\CodingTaskDataFeed\Helpers\Arr;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Schema;

class DynamicDB
{
    public function __construct()
    {
    }


    function createTable($name,$tableStructure)
    {
        if (schema()->tableExists($name)) {
            throw new \Exception("Table '{$name}' already exists");
        }
        $schema = new Schema();
        $newTable = $schema->createTable($name);
        if(!Arr::has($tableStructure,'id')){
            $newTable->addColumn("id", "integer", ['autoincrement' => true, 'unsigned' => true, 'notnull' => true]);
            $newTable->setPrimaryKey(["id"]);
        }
        foreach ($tableStructure as $column => $settings) {
            $newTable->addColumn($column, $settings['type'], $settings['options']);
        }
        try {
            schema()->createTable($newTable);
        } catch (Exception $exception) {
            echo $exception->getMessage()."\n";
            return false;
        }
        return true;
    }

    function updateTable($name,$tableStructure){
        //TODO
    }
    function dropTable($name){
        //TODO
    }
}