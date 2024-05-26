<?php

namespace Alex\CodingTaskDataFeed\Tests;

use Alex\CodingTaskDataFeed\Console;
use Exception;
use \PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertTrue;

class ImportXmlTest extends TestCase{
    public function testImportXmlCommand()
    {
        $db = db_conn();
        $db->beginTransaction();
        try {
            $status = (new Console())->run(['./bin/run.php', 'import:xml', 'feed.xml']);
            assertTrue($status==0);
            $db->rollBack();
        }catch (Exception $e){
            echo $e->getMessage()."\n";
            $db->rollBack();
        }
    }

    public function testImportXmlCommandWithTableOption()
    {
        $db = db_conn();
        $db->beginTransaction();
        try {
            $status = (new Console())->run(['./bin/run.php', 'import:xml', 'feed.xml','--table=exampletable2']);
            assertTrue($status==0);
            $db->rollBack();
        }catch (Exception $e){
            echo $e->getMessage()."\n";
            $db->rollBack();
        }
    }

    public function testCommandHelp()
    {
        $db = db_conn();
        $db->beginTransaction();
        try {
            $status = (new Console())->run(['./bin/run.php', 'import:xml', 'feed.xml','--table=exampletable2','--help']);
            assertTrue($status==1);
            $db->rollBack();
        }catch (Exception $e){
            echo $e->getMessage()."\n";
            $db->rollBack();
        }
    }
}