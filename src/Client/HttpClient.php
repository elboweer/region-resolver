<?php

namespace App\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    /**
     * @var Client
     */
    private $guzzleClient;

    public function __construct(Client $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * @param $url
     * @param $headers
     * @param string $method
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
    public function send($url, $headers = null, $method = 'GET')
    {
        $response = $this->guzzleClient->request($method, $url, [
            'headers' => $headers
        ]);

        return $response->getBody()->getContents();
    }
}