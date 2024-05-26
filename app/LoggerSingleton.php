<?php

namespace Alex\CodingTaskDataFeed;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class LoggerSingleton
{
    private static $instance = null;
    private $logger;

    private function __construct($loggerName = 'default',$level = Level::Debug)
    {
        $this->logger = new Logger($loggerName);
        $driver = config('log.channel');
        $path = storage_path('logs/' . config("log.channels.$driver"));
        $this->logger->pushHandler(new StreamHandler($path, $level));
    }

    public static function getInstance():LoggerSingleton
    {
        if (self::$instance == null) {
            self::$instance = new LoggerSingleton();
        }
        return self::$instance;
    }

    public function getLogger(): Logger
    {
        return $this->logger;
    }
}