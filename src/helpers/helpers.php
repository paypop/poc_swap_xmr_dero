<?php

use GuzzleHttp\Client;

function loadMarket() {

}

/**
 * @param float $value
 * @param int $atomic
 * @return int
 */
function convertToAtomic( float $value, int $atomic) : int {
    return $value * $atomic;
}

/**
 * @param float $value
 * @param int $atomic
 * @return float
 */
function convertToValue(float $value, int $atomic) : float {
    return $atomic / $value;
}

function convertFloat($floatAsString)
{
    $norm = strval(floatval($floatAsString));

    if (($e = strrchr($norm, 'E')) === false) {
        return $norm;
    }

    return number_format($norm, -intval(substr($e, 1)));
}

function convertSwapSatToSat(float $value_btc_coin_a, float $value_btc_coin_b, int $sat_level_a, int $sat_level_b, int $sat_received) {
    $coin_atomic_to_absolute = $sat_received / $sat_level_a;

    $value_coin_a_btc = $coin_atomic_to_absolute * $value_btc_coin_a;

    $coin_b = $value_coin_a_btc / $value_btc_coin_b;
    $coin_b_atomic = $coin_b * $sat_level_b;
    $coin_b_atomic = (int) round($coin_b_atomic);

    return $coin_b_atomic;
}

function colorLog(string $str, string $type = '') {
    switch ($type) {
        case 'e': //error
            echo "\033[31m$str \033[0m\n";
            break;
        case 's': //success
            echo "\033[32m$str \033[0m\n";
            break;
        case 'w': //warning
            echo "\033[33m$str \033[0m\n";
            break;
        case 'i': //info
            echo "\033[36m$str \033[0m\n";
            break;
        default:
            echo "$str \n";
            break;
    }
}