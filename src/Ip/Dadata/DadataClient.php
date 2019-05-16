<?php


namespace App\Ip\Dadata;


use App\Client\HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class DadataClient
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var string
     */
    private $token;

    public function __construct(HttpClient $httpClient, string $token)
    {
        $this->httpClient = $httpClient;
        $this->token = $token;
    }

    /**
     * @param string $ip
     * @return mixed
     * @throws GuzzleException
     */
    public function getRegionInfo(string $ip)
    {
        $parameters = [
            'Accept' => 'application/json',
            'Authorization' => sprintf('Token %s', $this->token)
        ];

        $url = sprintf('https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address?ip=%s', $ip);

        return json_decode($this->httpClient->send($url, $parameters));
    }
}