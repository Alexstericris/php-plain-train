<?php


use Alex\CodingTaskDataFeed\Console;
use \PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertTrue;

class ImportCsvTest extends TestCase{
    public function testImportCsvCommand()
    {
        $db = db_conn();
        $db->beginTransaction();
        try {
            $status = (new Console())->run(['./bin/run.php', 'import:csv', 'feedxml.csv']);
            assertTrue($status==0);
            $db->rollBack();
        }catch (Exception $e){
            echo $e->getMessage()."\n";
            $db->rollBack();
        }
    }

    public function testImportCsvCommandWithTableOption()
    {
        $db = db_conn();
        $db->setTransactionIsolation(\Doctrine\DBAL\TransactionIsolationLevel::READ_UNCOMMITTED);
        $db->beginTransaction();
        try {
            $status = (new Console())->run(['./bin/run.php', 'import:csv', 'feedxml.csv','--table=exampletable2']);
            assertTrue($status==0);
            $db->rollBack();
        }catch (Exception $e){
            echo $e->getMessage()."\n";
            $db->rollBack();
        }
    }
}