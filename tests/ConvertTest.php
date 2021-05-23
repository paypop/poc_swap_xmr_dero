<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ConvertTest extends TestCase
{
    public function test1() {
        $this->assertEquals(1e5, 100_000);
        $this->assertEquals(1e12, 1_000_000_000_000);
    }

    public function test3() {
        $result = convertSwapSatToSat(100_000, 0.00678127, 10000, 1000000000000, 40_000);
        dd($result);
    }
}