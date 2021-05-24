<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Swap\WalletService;

final class WalletMoneroTest extends TestCase
{
    private string $monero_rpc = 'http://localhost:38083/json_rpc';

    public function testGetAddress()
    {
        $monero_wallet_service = new WalletService($this->monero_rpc, 'xmr');

        $result = $monero_wallet_service->getAddress();
        $result = $result->address;

        $address_len = strlen($result);

        $this->assertTrue($address_len === 95);
    }

    public function testMakeIntegratedAddress()
    {
        $monero_wallet_service = new WalletService($this->monero_rpc, 'xmr');

        $result = $monero_wallet_service->makeIntegratedAddress('7c5b6f1c958ba98b');
        // dd($address);

        $this->assertObjectHasAttribute('integrated_address', $result);
        $this->assertObjectHasAttribute('payment_id', $result);
    }

    public function testTransfer()
    {
        $amount = 1500;
        $address = '5AU9jS3AkcS7n2zYcUGJ4qYvabjkcuwcD4JScVD1EyJWRwUkQyxpiFRAFRCktCg9TrLLGRpaPiCHiT9ZCmMm2zJmDmJUno6';

        $monero_wallet_service = new WalletService($this->monero_rpc, 'xmr');
        dd($monero_wallet_service->transfer($amount, $address));
    }

    public function testGetPaymentId()
    {
        $payment_id = 'ef38eada353696bb';

        $monero_wallet_service = new WalletService($this->monero_rpc, 'xmr');
        dd($monero_wallet_service->getPayment($payment_id));
    }
}