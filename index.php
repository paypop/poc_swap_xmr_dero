<?php

/**
 *  Dero dARCH 2021 Event 0.5 — Services Only
 *
 * by T3ster
 */

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$client_market = new Client([
    'base_uri' => 'https://tradeogre.com/api/v1/markets',
    'timeout'  => 2.0,
    'verify' => false
]);
$response_market = $client_market->request('GET', '', []);
$body_market = (string) $response_market->getBody()->getContents();
$body_market = json_decode($body_market, true);

$btc_dero = (float) 0;
$btc_xmr = (float) 0;

foreach ($body_market as $key => $value) {
    if (key_exists('BTC-DERO', $value)) {
        $price = $body_market;
        $price = $price[$key];
        $price = $price['BTC-DERO'];
        $price = $price['price'];
        $btc_dero = (float) $price;
    }

    if (key_exists('BTC-XMR', $value)) {
        $price = $body_market;
        $price = $price[$key];
        $price = $price['BTC-XMR'];
        $price = $price['price'];
        $btc_xmr = (float) $price;
    }
}

// Dero http request

$client_dero = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://localhost:40403',
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);

$body_get_transfers_in = [
    'jsonrpc' => '2.0',
    'id' => '1',
    'method' => 'get_transfers',
    'params' => [
        'In' => true
    ]
];

$response_get_transfers_in = $client_dero->request('POST', '/json_rpc', [
    'json' => $body_get_transfers_in
]);

$transfers_dero_in = (string) $response_get_transfers_in->getBody()->getContents();
$transfers_dero_in = json_decode($transfers_dero_in);

foreach ($transfers_dero_in->result->entries as $entry) {

    $payload_rpc = $entry->payload_rpc;

    $payload_rpc_value = $payload_rpc[0]->value;
    if (strlen($payload_rpc_value) != 95) {
        continue;
    }

    $txid = $entry->txid;
    $sender = $entry->sender;
    $amount = $entry->amount;


    $monero_sat = convertSwapSatToSat($btc_dero, $btc_xmr, 100000, 1000000000000, $amount);

    $monero_address = $payload_rpc_value;

    // Send monero
    $client_xmr = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'http://localhost:38083',
        // You can set any number of default request options.
        'timeout'  => 2.0,
    ]);


    $body_xmr_transfer = [
        'jsonrpc' => '2.0',
        'id' => '1',
        'method' => 'transfer',
        'params' => [
            'destinations' => [
                [
                    'amount' => $monero_sat,
                    'address' => $monero_address
                ]
            ]
        ]
    ];


    $response_get_transfers_in = $client_dero->request('POST', '/json_rpc', [
        'json' => $body_xmr_transfer
    ]);

    $result = (string) $response_get_transfers_in->getBody()->getContents();

    if ($result) {
        echo "We have receided the dero and sent your monero";
    }

}