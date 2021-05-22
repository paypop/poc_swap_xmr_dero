<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use MongoDB\Client;

final class DatabaseTest extends TestCase
{
    public function testConnection()
    {
        $collection = (new MongoDB\Client)->exchange_service->transactions;

        $transactions = $collection->insertOne([
            'txid' => 'eee'
        ]);

        $this->assertTrue(true);
    }
}