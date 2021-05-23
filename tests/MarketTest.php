<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Swap\Market;

final class MarketTest extends TestCase
{
    // dero-dero or xmr-monero
    protected $market_name = 'dero-dero';

    public function testMaket() {
        $market = new Market($this->market_name);
        dd($market);
    }

    public function testPrice() {
        $market = new Market($this->market_name);
        dd($market->price());
    }
}