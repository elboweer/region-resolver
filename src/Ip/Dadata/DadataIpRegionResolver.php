<?php


namespace App\Ip\Dadata;


use App\Ip\IpRegionResolverInterface;
use App\Region\Region;
use App\Region\RegionFactory;
use GuzzleHttp\Exception\GuzzleException;

class DadataIpRegionResolver implements IpRegionResolverInterface
{
    /**
     * @var DadataClient
     */
    private $dadataClient;

    /**
     * @var RegionFactory
     */
    private $regionFactory;

    public function __construct(
        DadataClient $dadataClient,
        RegionFactory $regionFactory)
    {
        $this->dadataClient = $dadataClient;
        $this->regionFactory = $regionFactory;
    }

    /**
     * @param string $ip
     * @return Region|null
     * @throws GuzzleException
     */
    public function resolve(string $ip) : ?Region
    {
        $regionInfo = $this->dadataClient->getRegionInfo($ip);
        if ($regionInfo->location) {
            return $this->regionFactory->create(
                $regionInfo->location->data->country,
                sprintf('%s %s', $regionInfo->location->data->region, $regionInfo->location->data->region_type_full),
                $regionInfo->location->data->city
            );
        } else {
            return null;
        }
    }
}