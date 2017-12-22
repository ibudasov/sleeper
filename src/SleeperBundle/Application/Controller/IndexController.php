<?php

declare(strict_types=1);

namespace SleeperBundle\Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route("/")
     *
     * @return JsonResponse
     */
    public function indexAction(): JsonResponse
    {
        return new JsonResponse([
            'Sleeper API dummy response.',
            'For actual response -- look documentation: https://github.com/ibudasov/sleeper'
        ]);
    }
}
