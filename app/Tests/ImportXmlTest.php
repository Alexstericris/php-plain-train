<?php

namespace Alex\CodingTaskDataFeed\Tests;


use Alex\CodingTaskDataFeed\Console;
use \PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertTrue;

class ImportXmlTest extends TestCase{
    public function testImportXmlCommand()
    {
        //TODO implement transaction

        $count = db()->select('COUNT(*)')
            ->from('feedxml')
            ->executeQuery()->fetchOne();
        $status = (new Console())->run(['./bin/run.php', 'import:xml', 'feed.xml']);
        assertTrue($status==0);
        $newCount = db()->select('COUNT(*)')
            ->from('feedxml')
            ->executeQuery()->fetchOne();
        assertTrue($newCount>$count);
    }

    public function testImportXmlCommandWithTableOption()
    {
        $count = db()->select('COUNT(*)')
            ->from('exampletable2')
            ->executeQuery()->fetchOne();
        $status = (new Console())->run(['./bin/run.php', 'import:xml', 'feed.xml','--table=exampletable2']);
        assertTrue($status==0);
        $newCount = db()->select('COUNT(*)')
            ->from('exampletable2')
            ->executeQuery()->fetchOne();
        assertTrue($newCount>$count);
    }
}