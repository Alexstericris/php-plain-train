<?php
namespace Alex\CodingTaskDataFeed;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

class Database
{

    private $connection;

    function __construct()
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


    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }
}