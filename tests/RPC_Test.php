<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

final class RPC_Test extends TestCase
{
    // XMR
    public function testXmrGetBalance()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://localhost:38083',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $json = [
            'jsonrpc' => '2.0',
            'id' => '1',
            'method' => 'get_balance',
            'params' => [

            ]
        ];

        $response = $client->request('POST', '/json_rpc', compact('json'));

        $content = (string) $response->getBody()->getContents();
        $content = json_decode($content, true);

        $result = $content['result'];

        echo "balance: {$result['balance']}";

        $this->assertArrayHasKey('balance', $result);
    }

    public function testXmrTransfer()
    {
        $address_receiver = '5AU9jS3AkcS7n2zYcUGJ4qYvabjkcuwcD4JScVD1EyJWRwUkQyxpiFRAFRCktCg9TrLLGRpaPiCHiT9ZCmMm2zJmDmJUno6';

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://localhost:38083',
            // You can set any number of default request options.
            'timeout'  => 5.0,
        ]);

        $json = [
            'jsonrpc' => '2.0',
            'id' => '1',
            'method' => 'transfer',
            'params' => [
                'destinations' => [
                    [
                        'address' => $address_receiver,
                        'amount' => 4444
                    ]
                ]
            ]
        ];

        $response = $client->request('POST', '/json_rpc', compact('json'));

        $content = (string) $response->getBody()->getContents();
        $content = json_decode($content, true);
        dd($content);

        $result = $content['result'];
        dd($result);
    }

    // DERO
    public function testDeroGetBalance()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://localhost:40403',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $json = [
            'jsonrpc' => '2.0',
            'id' => '1',
            'method' => 'getbalance',

        ];

        $response = $client->request('POST', '/json_rpc', compact('json'));

        $content = (string) $response->getBody()->getContents();
        $content = json_decode($content, true);

        $result = $content['result'];

        echo "balance: {$result['balance']}";

        $this->assertArrayHasKey('balance', $result);
    }

    public function testDeroTransfer()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://localhost:40403',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $json = [
            'jsonrpc' => '2.0',
            'id' => '1',
            'method' => 'transfer',
            'params' => [
                'destinations' => [
                    [
                        'address' => 'deto1qxqzmrx0j7lxjdx8qd00wvxe2ttgz426kmvwx2kk4d2chces0tly44s23puys',
                        'amount' => 963
                    ]
                ]
            ]
        ];

        $response = $client->request('POST', '/json_rpc', compact('json'));

        $content = (string) $response->getBody()->getContents();
        $content = json_decode($content, true);
        dd($content);

        $result = $content['result'];

        echo "balance: {$result['balance']}";

        $this->assertArrayHasKey('balance', $result);
    }
}