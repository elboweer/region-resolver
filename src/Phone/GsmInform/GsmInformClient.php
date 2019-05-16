<?php


namespace App\Phone\GsmInform;


use App\Client\HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class GsmInformClient
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param int $phone
     * @return mixed
     * @throws GuzzleException
     */
    public function getRegionInfo(int $phone)
    {
        $url = sprintf('https://gsm-inform.ru/api/info/?phone=%d&get-phone-info=on', $phone);

        return json_decode($this->httpClient->send($url));
    }

}