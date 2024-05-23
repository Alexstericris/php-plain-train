<?php
require __DIR__ . '/../../vendor/autoload.php';

$table = 'exampletable2';
$tableOptions = config("imports.$table");
$dynamicDB = new \Alex\CodingTaskDataFeed\Services\DynamicDB();
$dynamicDB->createTable($table, $tableOptions);
