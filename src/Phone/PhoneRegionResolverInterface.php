<?php


namespace App\Phone;


use App\Region\Region;

interface PhoneRegionResolverInterface
{
    public function resolve(int $phone): ?Region;
}