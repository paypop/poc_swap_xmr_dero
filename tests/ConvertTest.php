<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ConvertTest extends TestCase
{
    public function test1() {
        $this->assertEquals(1e5, 100_000);
        $this->assertEquals(1e12, 1_000_000_000_000);
    }

    public function testConvertToAtomic() {
        // test Dero
        $conversion = convertAmountToAtomic((float) 1, (int) 1e5);
        $this->assertEquals($conversion, 100_000);

        $conversion = convertAmountToAtomic((float) 0.4, (int) 1e5);
        $this->assertEquals($conversion, 40_000);

        $conversion = convertAmountToAtomic((float) 0.00001, (int) 1e5);
        $this->assertEquals($conversion, 1);

        // test monero
        $conversion = convertAmountToAtomic((float) 1, (int) 1e12);
        $this->assertEquals($conversion, 1_000_000_000_000);

        $conversion = convertAmountToAtomic((float) 0.06, (int) 1e12);
        $this->assertEquals($conversion, 60_000_000_000);

        $conversion = convertAmountToAtomic((float) 0.000_000_000_001, (int) 1e12);
        $this->assertEquals($conversion, 1);


    }

    public function testConvertToValue() {
        // test Dero
        $conversion = convertAtomicToAmount(100_000, (int) 1e5);
        $this->assertEquals($conversion, 1);


        dd(convertAtomicToAmount(14933027083, (int) 1e12));
    }

    public function testConvertFloat() {
        $r = convertFloat(1.0E5);
        dd($r);
    }

    public function test3() {
        $result = convertSwapSatToSat(0.00008998, 0.00602557, (int) 1e5, (int) 1e12, 100000);
        dd(convertFloat($result));
    }
}