<?php declare(strict_types=1);

namespace SleeperBundle\Controller;

use SleeperBundle\Service\SleepService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AnalyzerController
{
    /** @var  SleepService */
    private $sleepService;

    /** @param SleepService $sleepService */
    public function __construct(SleepService $sleepService) {
        $this->sleepService = $sleepService;
    }

    /**
     * @Route("/")
     * @return JsonResponse
     */
    public function indexAction(): JsonResponse
    {
        $sleepResponse = $this->sleepService->getSleepOnDate(new \DateTime());

        return new JsonResponse('banaan');
    }
}
