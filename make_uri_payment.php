<?php

require __DIR__ . '/vendor/autoload.php';

# Load .env
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

# Start the script
$xmr_address_back_if_problem = readline('Your monero address: (you take back your money if there is a problem): ');
$xmr_amount = readline('Amount to send: (in XMR not atomic unit): ');
$dero_address = readline('Your dero address: ');

echo "\n";
echo "Your monero address: {$xmr_address_back_if_problem} \n";
echo "The amount in XMR : {$xmr_amount} \n";
echo "Dero address: {$dero_address} \n";
echo "\n";

$confirm = readline('Is that correct ? Y, y, N, n ');

if ($confirm != 'Y' || $confirm != 'y') {
    echo "Impossible to create the uri";
}

$tx_description = compact('xmr_address_back_if_problem', 'dero_address');
$tx_description = json_encode($tx_description);
$tx_description = base64_encode($tx_description);

$uri = [
    'address' => getenv('xmr_wallet_service'),
    'amount' => $xmr_amount,
    compact('tx_description')
];
dd($uri);



echo "\n";

echo "tx_description: {$uri}";



