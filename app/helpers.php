<?php

use Alex\CodingTaskDataFeed\Helpers\Arr;
use Alex\CodingTaskDataFeed\Database;
use Alex\CodingTaskDataFeed\LoggerSingleton;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Schema\AbstractSchemaManager;

function env($key, $default = null): string
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
    $dotenv->load();
    if (!key_exists($key, $_ENV)) {
        return $default;
    }
    return $_ENV[$key];
}

function project_root_path(): string
{
    return __DIR__ . '/../';
};

function database_path($fileName): string
{
    return __DIR__ . '/../database/'.$fileName;
}

function config_path($fileName): string
{
    return __DIR__ . '/../config/'.$fileName.'.php';
}


function config($key, $default = null): mixed
{
    $configDir = __DIR__ . '/../config/';
    $configPath = explode('.', $key);
    if ($configPath<1) {
        return $default;
    }
    $configFileName = $configPath[0];
    if (!file_exists(config_path($configFileName))) {
        return $default;
    }
    $config = include config_path($configFileName);
    $arrPath = explode('.', $key, 2);
    if(!key_exists(1,$arrPath)) {
        return $default;
    }
    return Arr::get($config, $arrPath[1]);

}

function db_conn()
{
    return (new Database())->getConnection();
}


function db(): QueryBuilder
{
    $conn = db_conn();
    return $conn->createQueryBuilder();
}

function schema(): AbstractSchemaManager
{
    $conn = db_conn();
    return $conn->createSchemaManager();
}

function log_info($message): void
{
    $logger = LoggerSingleton::getInstance()->getLogger();
    $logger->info($message);
}

function log_error($message): void
{
    $logger = LoggerSingleton::getInstance()->getLogger();
    $logger->error($message);
}


