#!/usr/bin/env php
<?php

require __DIR__ . './../vendor/autoload.php';
use Alex\CodingTaskDataFeed\Console;
//console run $_SERVER['argv']

$status=(new Console())->run($_SERVER['argv']);

exit($status);