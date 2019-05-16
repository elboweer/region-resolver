<?php

namespace App\Ip\Controller;

use App\Ip\IpRegionResolverInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    /**
     * @var IpRegionResolverInterface
     */
    private $ipRegionResolver;

    public function __construct(IpRegionResolverInterface $ipRegionResolver)
    {
        $this->ipRegionResolver = $ipRegionResolver;
    }

    /**
     * @Route("/ip/resolve/{ip}", name="api_region_ip_resolve")
     * @param $ip
     * @return JsonResponse
     */
    public function resolve($ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new BadRequestHttpException('Invalid IP');
        }

        return $this->json($this->ipRegionResolver->resolve($ip));
    }
}