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
     * dero or xmr
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

            'timeout' => '8.0'
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

    public function makeIntegratedAddress($data_info)
    {
        if ($this->currency === 'dero') {
            $params = [
                'payload_rpc' => [
                    [
                        'name' => 'monero_address_destination',
                        'datatype' => 'S',
                        'value' => $data_info
                    ],
                    [
                        'name' => 'D',
                        'datatype' => 'U',
                        'value' => 2525
                    ]
                ]
            ];
        }
        else if ($this->currency === 'xmr') {
            $params = [
                'payment_id' => $data_info
            ];
        }

        return $this->request('make_integrated_address', $params);
    }

    public function getTransfers()
    {
        if ($this->currency === 'dero') {
            $params = [
                "In" => true,
                "Out" => false
            ];
        }
        else if ($this->currency === 'xmr') {
            $params = [
                "in" => true,
                "out" => false
            ];
        }


        return $this->request('get_transfers', $params);
    }

    public function transfer(int $amount, string $address)
    {
        if ($this->currency === 'xmr') {
            $params = [
                'destinations' => [
                    [
                        'amount' => $amount,
                        'address' => $address
                    ]
                ],
                'account_index' => 0,
                'subaddr_indices' => [0],
                'priority' => 3,
                'ring_size' => 7,
                'get_tx_key' => true
            ];
        }
        else if ($this->currency === 'dero') {
            $params = [
                'destinations' => [
                    [
                        'address' => $address,
                        'amount' => $amount
                    ]
                ]
            ];
        }

        return $this->request('transfer', $params);
    }

    public function getPayment(string $payment_id) {
        // only for monero

        $params = compact('payment_id');

        return $this->request('get_payments', $params);
    }
}