<?php


namespace App\Phone\GsmInform;


use App\Phone\PhoneRegionResolverInterface;
use App\Region\Region;
use App\Region\RegionFactory;
use GuzzleHttp\Exception\GuzzleException;

class GsmInformPhoneRegionResolver implements PhoneRegionResolverInterface
{
    /**
     * @var GsmInformClient
     */
    private $gsmInformClient;

    /**
     * @var RegionFactory
     */
    private $regionFactory;

    public function __construct(
        GsmInformClient $gsmInformClient,
        RegionFactory $regionFactory)
    {
        $this->gsmInformClient = $gsmInformClient;
        $this->regionFactory = $regionFactory;
    }

    /**
     * @param int $phone
     * @return Region|null
     * @throws GuzzleException
     */
    public function resolve(int $phone): ?Region
    {
        $regionInfo = $this->gsmInformClient->getRegionInfo($phone);
        if ($regionInfo->error == 'ok') {
            return $this->regionFactory->create(
                $regionInfo->country,
                isset($regionInfo->region) ? $regionInfo->region->name : null,
                null);
        } else {
            return null;
        }
    }
}