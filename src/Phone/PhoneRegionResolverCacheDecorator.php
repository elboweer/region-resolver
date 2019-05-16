<?php


namespace App\Phone;


use App\Region\Region;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class PhoneRegionResolverCacheDecorator implements PhoneRegionResolverInterface
{
    /**
     * @var PhoneRegionResolverInterface
     */
    private $phoneRegionResolver;

    /**
     * @var AdapterInterface
     */
    private $cache;

    public function __construct(PhoneRegionResolverInterface $phoneRegionResolver, AdapterInterface $cache)
    {
        $this->phoneRegionResolver = $phoneRegionResolver;
        $this->cache = $cache;
    }

    /**
     * @param int $phone
     * @return Region|null
     * @throws InvalidArgumentException
     */
    public function resolve(int $phone): ?Region
    {
        $cachedResult = $this->cache->getItem((string)$phone);

        if ($cachedResult->isHit()) {
            return $cachedResult->get();
        }

        $result = $this->phoneRegionResolver->resolve($phone);

        if ($result instanceof Region) {
            $this->cache->save($cachedResult->set($result));
        };

        return $result;
    }
}