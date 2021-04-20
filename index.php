<?php

require __DIR__ . '/vendor/autoload.php';

# Load .env
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

// get tx id
$tx_id = $argv[1];


