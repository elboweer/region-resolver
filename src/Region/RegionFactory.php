<?php


namespace App\Region;


class RegionFactory
{
    /**
     * @param string|null $country
     * @param string|null $region
     * @param string|null $city
     * @return Region
     */
    public function create(?string $country, ?string $region, ?string $city) : Region
    {
        if ($city === 'Москва' || $region === 'Москва и Московская область' || $region === 'Москва') {
            $region = 'Московская область';
        } else if ($city === 'Санкт-Петербург' || $region === 'Санкт-Петербург и Ленинградская область' || $region === 'Санкт-Петербург') {
            $region = 'Ленинградская область';
        } else if ($region === 'Ханты-Мансийский-Югра автономный округ, Тюменская область') {
            $region = 'Тюменская область';
        }

        return new Region($country, $region, $city);
    }
}