<?php


namespace App\Ip;


use App\Region\Region;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class IpRegionResolverCacheDecorator implements IpRegionResolverInterface
{
    /**
     * @var IpRegionResolverInterface
     */
    private $ipRegionResolver;

    /**
     * @var AdapterInterface
     */
    private $cache;

    public function __construct(IpRegionResolverInterface $ipRegionResolver, AdapterInterface $cache)
    {
        $this->ipRegionResolver = $ipRegionResolver;
        $this->cache = $cache;
    }

    /**
     * @param string $ip
     * @return Region|null
     * @throws InvalidArgumentException
     */
    public function resolve(string $ip): ?Region
    {
        $cachedResult = $this->cache->getItem($ip);

        if ($cachedResult->isHit()) {
            return $cachedResult->get();
        }

        $result = $this->ipRegionResolver->resolve($ip);

        if ($result instanceof Region) {
            $this->cache->save($cachedResult->set($result));
        };

        return $result;
    }
}