<?php

namespace Alex\CodingTaskDataFeed\Tests;

use Alex\CodingTaskDataFeed\Console;
use Doctrine\DBAL\TransactionIsolationLevel;
use Exception;
use \PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertTrue;

class ImportXmlTest extends TestCase{
    public function testImportXmlCommand()
    {
        $db = db_conn();
        $db->beginTransaction();
        $count = db()->select('COUNT(*)')
            ->from('feedxml')
            ->executeQuery()->fetchOne();
        $status = (new Console())->run(['./bin/run.php', 'import:xml', 'feed.xml']);
        assertTrue($status == 0);
        $newCount = db()->select('COUNT(*)')
            ->from('feedxml')
            ->executeQuery()->fetchOne();
        assertTrue($newCount > $count);
        $db->rollBack();
    }

    public function testImportXmlCommandWithTableOption()
    {
        $db = db_conn();
        $db->beginTransaction();
        $count = db()->select('COUNT(*)')
            ->from('exampletable2')
            ->executeQuery()->fetchOne();
        $status = (new Console())->run(['./bin/run.php', 'import:xml', 'feed.xml', '--table=exampletable2']);
        assertTrue($status == 0);
        $newCount = db()->select('COUNT(*)')
            ->from('exampletable2')
            ->executeQuery()->fetchOne();
        assertTrue($newCount > $count);
        $db->rollBack();
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