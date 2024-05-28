<?php
use Alex\CodingTaskDataFeed\Http\Request;
use Alex\CodingTaskDataFeed\App;
use Alex\CodingTaskDataFeed\Http\Router;

require __DIR__ . './../vendor/autoload.php';

$startTime = microtime(true);
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$endTime = microtime(true);
log_info("1 ".$endTime-$startTime);
$request = new Request($method, $uri);
$router = new Router();
$app = new App();
$app->registerRouter($router);
$endTime = microtime(true);
log_info("2 ".$endTime-$startTime);
$app->handle($request);
$endTime = microtime(true);
log_info("3 ".$endTime-$startTime);
exit();