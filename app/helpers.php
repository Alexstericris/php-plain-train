<?php

use Alex\CodingTaskDataFeed\Helpers\Arr;
use Alex\CodingTaskDataFeed\Database;

function env($key, $default = null)
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
    $dotenv->load();
    if (!key_exists($key, $_ENV)) {
        return $default;
    }
    return $_ENV[$key];
}

function database_path($fileName)
{
    return __DIR__ . '/../database/'.$fileName;
}

function config_path($fileName)
{
    return __DIR__ . '/../config/'.$fileName.'.php';
}


function config($key, $default = null)
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


function db()
{
    $conn = (new Database())->getConnection();
    return $conn->createQueryBuilder();
}

function schema()
{
    $conn = (new Database())->getConnection();
    return $conn->createSchemaManager();
}

