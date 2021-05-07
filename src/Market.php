<?php

namespace Swap;

use GuzzleHttp\Client;

class Market
{
    /**
     * @var string BTC-XMR or BTC-DERO
     */
    private string $name;

    private array $market = [];

    function __construct(string $name) {

        $this->name = $name;

        $client = new Client([
            'base_uri' => 'https://tradeogre.com/api/v1/markets',
            'timeout'  => 2.0,
            'verify' => false
        ]);
        $response = $client->request('GET', '', []);
        $body = (string) $response->getBody()->getContents();
        $body = json_decode($body, true);

        foreach ($body as $key => $value) {
            if ($name === array_key_first($value)) {
                $market = $body;
                $market = $market[$key];
                $market = $market[$name];

                $this->market = $market;
            }
        }
    }

    public function price() {
        return (float) $this->market['price'];
    }
}