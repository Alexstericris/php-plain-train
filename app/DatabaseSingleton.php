<?php
namespace Alex\CodingTaskDataFeed;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

class DatabaseSingleton
{

    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $driver = config('db.driver');
        $database = config("db.server.$driver.database");
        $connectionParams = [
            'driver' => $driver,
            'path' => $database,
        ];

        $config = new Configuration();
        $this->connection = DriverManager::getConnection($connectionParams, $config);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

}