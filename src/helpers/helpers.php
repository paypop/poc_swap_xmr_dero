<?php

/**
 * Convert amount to atomic
 * Example: convertToAtomin( $amount, 1e5 ) for dero, convertToAtomin( $amount, 1e12 ) for monero
 * @param float $value
 * @param int $atomic
 * @return int
 */
function convertAmountToAtomic( float $amount, int $atomic_level) : int {
    return $amount * $atomic_level;
}

/**
 * Convert atomic to amount
 * @param float $value
 * @param int $atomic
 * @return float
 */
function convertAtomicToAmount(int $amount, int $atomic_level) : float {
    return $amount / $atomic_level;
}

function convertFloat($floatAsString)
{
    $norm = strval(floatval($floatAsString));

    if (($e = strrchr($norm, 'E')) === false) {
        return $norm;
    }

    return number_format($norm, -intval(substr($e, 1)));
}

function convertSwapSatToSat(int $amount_sat_a, float $price_a, float $price_b, float $sat_level_a, float $sat_level_b): int {

    $amount_a = $amount_sat_a / $sat_level_a;

    $price_dollar_a = $amount_a * $price_a;

    $amount_b = $price_dollar_a / $price_b;

    $amount_b_sat = $amount_b * $sat_level_b;

    return (int) $amount_b_sat;
}

function colorLog(string $str, string $type = ''): void {
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

function clearScreen(): void {
    echo "________________________ \n";
    for ($i = 0; $i < 10; $i++) {
        echo "\r\n";
    }
}