<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Swap\WalletService;

final class WalletDeroTestTest extends TestCase
{
    /**
     * @var string
     */
    private string $dero_rpc = 'http://localhost:40403/json_rpc';

    /**
     *
     */
    public function testGetAddress()
    {
        $dero_wallet_service = new WalletService($this->dero_rpc, 'dero');

        $result = $dero_wallet_service->getAddress();

        $this->assertObjectHasAttribute('address', $result);
    }

    /**
     *
     */
    public function testMakeIntegratedAddress()
    {
        $dero_wallet_service = new WalletService($this->dero_rpc, 'dero');

        $result = $dero_wallet_service->makeIntegratedAddress();

        dd($result);
    }
}