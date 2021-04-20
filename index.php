<?php

require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('logs/info.log', Logger::INFO));

# Load .env
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

// get tx id
$tx_id = $argv[1];

// add records to the log
$log->info('Foo');
$log->info('Bar');

