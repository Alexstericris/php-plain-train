<?php
require __DIR__ . '/../../vendor/autoload.php';

$table = 'feedxml';
$tableOptions = config("imports.$table");
$dynamicDB = new \Alex\CodingTaskDataFeed\Services\DynamicDB();
$dynamicDB->createTable($table, $tableOptions);
