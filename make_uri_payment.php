<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

# Load .env
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

# Start the script
$xmr_address_back_if_problem = (string) readline('Your monero address: (you take back your money if there is a problem): ');
$xmr_amount = (int) readline('Amount to send: (in XMR not atomic unit): ');
$dero_address = (string) readline('Your dero address: ');

echo "\n";
echo "Your monero address: {$xmr_address_back_if_problem} \n";
echo "The amount in XMR : {$xmr_amount} \n";
echo "Dero address: {$dero_address} \n";
echo "\n";

$confirm = readline('Is that correct ? Y, y, N, n ');

if ( ! ($confirm === 'Y' || $confirm === 'y')) {
    echo "Impossible to create the uri";
    return;
}

$tx_description = compact('xmr_address_back_if_problem', 'dero_address');
$tx_description = json_encode($tx_description);
$tx_description = base64_encode($tx_description);

$params = [
    'address' => getenv('xmr_wallet_service'),
    'amount' => $xmr_amount,
    'tx_description' => $tx_description
];

$body = [
    'json_rpc'=> '2.0',
    'method' => 'make_uri',
    'params' => $params
];
$body = json_encode($body);

echo "\n";

$client = new Client();
$response = $client->request('POST', 'http://127.0.0.1:38083/json_rpc', compact('body'));
$result = $response->getBody()->getContents();
$result = json_decode($result);

echo "Copy this uri, and paste it in the address's transaction: \n";
dd($result->result->uri);

