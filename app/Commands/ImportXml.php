<?php

namespace Alex\CodingTaskDataFeed\Commands;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

class ImportXml extends Command
{

    protected $argvTemplate = "{xml}";
    protected $description = "This command imports xml files of the structure defined in imports config.";

    public function __construct(array $arguments)
    {
        parent::__construct($arguments);
    }

    public function handle(): int
    {

        //TODO implement xml parser and import into database
        echo "importxml command\n";
        echo env('DB_DRIVER');
//        $schema = new Schema();
//        $newTable=$schema->createTable('testtable');
//        $newTable->addColumn("id", "integer", ["unsigned" => true]);
//        $newTable->addColumn("username", "string", ["length" => 32]);
//        $newTable->setPrimaryKey(["id"]);
//        $newTable->addUniqueIndex(["username"]);
//        $newTable->setComment('Some comment');
//
//
//        $myForeign = $schema->createTable("my_foreign");
//        $myForeign->addColumn("id", "integer");
//        $myForeign->addColumn("user_id", "integer");
//        $myForeign->addForeignKeyConstraint($newTable->getName(), ["user_id"], ["id"], ["onUpdate" => "CASCADE"]);
//
//        schema()->createTable($newTable);
//        schema()->createTable($myForeign);
        return 0;
    }
}