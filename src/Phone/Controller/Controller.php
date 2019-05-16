<?php

namespace App\Phone\Controller;

use App\Phone\PhoneRegionResolverInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    /**
     * @var PhoneRegionResolverInterface
     */
    private $phoneRegionResolver;

    public function __construct(PhoneRegionResolverInterface $phoneRegionResolver)
    {
        $this->phoneRegionResolver = $phoneRegionResolver;
    }

    /**
     * @Route("/phone/resolve/{phone}", name="api_region_phone_resolve")
     * @param $phone
     * @return JsonResponse
     */
    public function regionPhoneResolve($phone)
    {
        $phone = preg_replace("/[^0-9]/", '', $phone);

        if (!$phone) {
            throw new BadRequestHttpException('Invalid phone');
        }

        return $this->json($this->phoneRegionResolver->resolve($phone));
    }
}