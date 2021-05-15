<?php

require __DIR__ . '/vendor/autoload.php';

use Swap\Swap;
use Swap\WalletService;

if ( ! file_exists('.env')) {
    dd("Create .env file first\ncp .env.example .env");
}

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

colorLog('SWAP DERO-XMR', 's');
colorLog('By T3ster', 'w');

colorLog('Choose an option:');
colorLog('1) swap dero -> xmr');
colorLog('2) swap xmr -> dero');

$swap_mode_question = '';
$swap_mode_answer = readline($swap_mode_question);


if ( ! ($swap_mode_answer === '1' || $swap_mode_answer === '2') ) {
    return colorLog('you have to chose 1 or 2', 'e');
}


if ($swap_mode_answer === '1') {

    $wallet_dero_service = getenv('DERO_WALLET_SERVICE');

    colorLog('You have some dero, you want some monero', 's');
    colorLog('Send some dero to this address', '');
    colorLog($wallet_dero_service, 'i');
    colorLog('As a comment, type your monero address !', 'e');
    colorLog('Send the transaction and wait for some seconds');
    colorLog('Then run this command:');
    colorLog('php swap-exe.php', 's');
    colorLog('Wait some seconds, open your monero wallet and check the balance');
}

if ($swap_mode_answer === '2') {

    $monero_rpc = getenv('MONERO_RPC');
    $monero_wallet_service = new WalletService($monero_rpc, 'xmr');

    $integrated_address = $monero_wallet_service->makeIntegratedAddress();
    $integrated_address = $integrated_address->integrated_address;

    colorLog('You have some monero, you want some dero', 's');

    $dero_wallet_user = readline('Type here your dero address ');

    if ( ! $dero_wallet_user) {
        return colorLog('Your address must be valid and get 66 characters', 'e');
    }

    colorLog('Send monero to this address:');
    colorLog($integrated_address, 'i');
    colorLog('Send the transaction and wait for some seconds');
    colorLog('Then run this command:');
    colorLog('php swap-exe.php', 's');
    colorLog('Wait some seconds, open your dero wallet and check the balance');
}


