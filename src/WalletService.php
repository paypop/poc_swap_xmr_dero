<?php

namespace Swap;

use GuzzleHttp\Client;


class WalletService
{
    /**
     * @var string
     */
    private string $rpc_address;

    /**
     * @var string
     */
    private string $currency;

    /**
     * WalletService constructor.
     * @param string $rpc_address
     * @param string $currency
     */
    function __construct(string $rpc_address, string $currency = 'dero')
    {
        $this->rpc_address = $rpc_address;
        $this->currency = $currency;
    }

    /**
     * @param string $method
     * @param null $params
     * @param string $currency
     */
    private function request(string $method, $params = null)
    {
        $data = [
            'id' => '1',
            'method' => $method
        ];

        if ($this->currency === 'dero') {
            $data['jsonrpc'] = '2.0';
        }
        else {
            $data['json_rpc'] = '2.0';
        }

        if ($params) {
            $data['params'] = $params;
        }

        $client = new Client([
            'base_uri' => $this->rpc_address,

            'timeout' => '2.0'
        ]);

        $response = $client->request('POST', 'json_rpc', [
            'json' => $data
        ]);
        $body = $response->getBody()->getContents();

        $body = json_decode($body);

        $result = $body->result;

        return $result;
    }

    public function getAddress()
    {
        $method = '';

        if ($this->currency == 'dero') {
            $method = 'getaddress';
        }
        else {
            $method = 'get_address';
        }

        return $this->request($method);
    }

    public function makeIntegratedAddress()
    {
        $payment_id = random_bytes(8);
        $payment_id = bin2hex($payment_id);

        if ($this->currency === 'dero') {
            $params = [
                'payload_rpc' => [
                    [
                        'name' => 'payment_id',
                        'datatype' => 'S',
                        'value' => $payment_id
                    ]
                ]
            ];
        }
        else if ($this->currency === 'xmr') {
            $params = [
                'payment_id' => $payment_id
            ];
        }

        return $this->request('make_integrated_address', $params);
    }

}