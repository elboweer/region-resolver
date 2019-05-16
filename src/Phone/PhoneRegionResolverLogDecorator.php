<?php


namespace App\Phone;


use App\Region\Region;
use Psr\Log\LoggerInterface;

class PhoneRegionResolverLogDecorator implements PhoneRegionResolverInterface
{
    /**
     * @var PhoneRegionResolverInterface
     */
    private $phoneRegionResolver;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        PhoneRegionResolverInterface $phoneRegionResolver,
        LoggerInterface $logger)
    {
        $this->phoneRegionResolver = $phoneRegionResolver;
        $this->logger = $logger;
    }

    public function resolve(int $phone): ?Region
    {
        $this->logger->info('Phone resolve request: '.$phone);
        return $this->phoneRegionResolver->resolve($phone);
    }
}