<?php


use Alex\CodingTaskDataFeed\Console;
use \PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertTrue;

class ImportExcelTest extends TestCase{
    public function testImportExcelCommand()
    {
        $db = db_conn();
        $db->beginTransaction();
        $count = db()->select('COUNT(*)')
            ->from('feedxml')
            ->executeQuery()->fetchOne();
        $status = (new Console())->run(['./bin/run.php', 'import:excel', 'feedxml.xlsx']);
        assertTrue($status == 0);
        $newCount = db()->select('COUNT(*)')
            ->from('feedxml')
            ->executeQuery()->fetchOne();
        assertTrue($newCount > $count);
        $db->rollBack();
    }

    public function testImportExcelCommandWithTableOption()
    {
        $db = db_conn();
        $db->beginTransaction();
        $count = db()->select('COUNT(*)')
            ->from('exampletable2')
            ->executeQuery()->fetchOne();
        $status = (new Console())->run(['./bin/run.php', 'import:excel', 'feedxml.xlsx', '--table=exampletable2']);
        assertTrue($status == 0);
        $newCount = db()->select('COUNT(*)')
            ->from('exampletable2')
            ->executeQuery()->fetchOne();
        assertTrue($newCount > $count);
        $db->rollBack();
    }
}