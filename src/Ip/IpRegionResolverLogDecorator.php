<?php


namespace App\Ip;


use App\Region\Region;
use Psr\Log\LoggerInterface;

class IpRegionResolverLogDecorator implements IpRegionResolverInterface
{
    /**
     * @var IpRegionResolverInterface
     */
    private $ipRegionResolver;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        IpRegionResolverInterface $ipRegionResolver,
        LoggerInterface $logger)
    {
        $this->ipRegionResolver = $ipRegionResolver;
        $this->logger = $logger;
    }

    public function resolve(string $ip): ?Region
    {
        $this->logger->info('IP resolve request: '.$ip);
        return $this->ipRegionResolver->resolve($ip);
    }
}