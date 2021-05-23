<?php

namespace Swap;

use GuzzleHttp\Client;

class Market
{
    /**
     * @var string dero-dero or xmr-monero
     */
    private string $name;

    private array $market = [];

    function __construct(string $name) {

        $this->name = $name;

        $client = new Client([
            'base_uri' => "https://api.coinpaprika.com/v1/coins/{$name}/markets",
            'timeout'  => 2.0,
            'verify' => false
        ]);
        $response = $client->request('GET', '', []);
        $body = (string) $response->getBody()->getContents();
        $body = json_decode($body);

        $market = array_filter($body, function($exchange) {
            return $exchange->exchange_name === 'TradeOgre';
        });

        $market = array_values($market);
        $market = $market[0];

        $this->market = (array) $market;
    }

    public function price() {
        return $this->market['quotes']->USD->price;
    }
}