<?php

namespace App\Region;

class Region
{
    /**
     * @var string|null
     */
    private $country;

    /**
     * @var string|null
     */
    private $region;

    /**
     * @var string|null
     */
    private $city;

    public function __construct(?string $country, ?string $region, ?string $city)
    {
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }
}