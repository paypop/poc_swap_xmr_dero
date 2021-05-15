<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Swap\WalletService;

final class WalletTest extends TestCase
{
    private string $dero_rpc = 'http://localhost:40403/json_rpc';

    private string $monero_rpc = 'http://localhost:38083/json_rpc';

    public function testDeroGetAddress()
    {
        $dero_wallet_service = new WalletService($this->dero_rpc, 'dero');

        $result = $dero_wallet_service->getAddress();

        $this->assertObjectHasAttribute('address', $result);
    }

    public function testMoneroGetAddress()
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

        $result = $monero_wallet_service->makeIntegratedAddress();
        // dd($address);

        $this->assertObjectHasAttribute('integrated_address', $result);
        $this->assertObjectHasAttribute('payment_id', $result);
    }
}