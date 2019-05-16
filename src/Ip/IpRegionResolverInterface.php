<?php


namespace App\Ip;


use App\Region\Region;

interface IpRegionResolverInterface
{
    public function resolve(string $ip): ?Region;
}