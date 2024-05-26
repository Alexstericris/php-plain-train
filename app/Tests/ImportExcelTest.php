<?php


use Alex\CodingTaskDataFeed\Console;
use \PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertTrue;

class ImportExcelTest extends TestCase{
    public function testImportExcelCommand()
    {
        $db = db_conn();
        $db->beginTransaction();
        try {
            $status = (new Console())->run(['./bin/run.php', 'import:excel', 'feedxml.xlsx']);
            assertTrue($status==0);
            $db->rollBack();
        }catch (Exception $e){
            echo $e->getMessage()."\n";
            $db->rollBack();
        }
    }

    public function testImportExcelCommandWithTableOption()
    {
        $db = db_conn();
        $db->beginTransaction();
        try {
            $status = (new Console())->run(['./bin/run.php', 'import:excel', 'feedxml.xlsx', '--table=exampletable2']);
            assertTrue($status == 0);
            $db->rollBack();
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
            $db->rollBack();
        }
    }
}