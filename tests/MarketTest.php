<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Swap\Market;

final class MarketTest extends TestCase
{
    public function testMaket() {
        $market = new Market('BTC-XMR');
        dd($market);
    }

    public function testPrice() {
        $market = new Market('BTC-XMR');
        dd($market->price());
    }
}