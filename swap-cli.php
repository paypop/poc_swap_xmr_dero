<?php

require __DIR__ . '/vendor/autoload.php';

use Swap\Swap;

$menu = "
SWAP DERO-XMR 

By T3ster \n
";

$swap_mode_question = "
1) swap dero -> xmr
2) swap xmr -> dero
";

echo $menu;

$swap_mode_answer = readline($swap_mode_question);

if ( ! ($swap_mode_answer === '1' || $swap_mode_answer === '2') ) {
    echo "you have to chose 1 or 2";
    return;
}

$swap = new Swap;

if ($swap_mode_answer === '1') {
    echo "Send dero to this address: \n";


    $swap->convertCoinAToCoinB('dero', 'xmr');
}

if ($swap_mode_answer === '1') {
    $swap->convertCoinAToCoinB('xmr', 'dero');
}


