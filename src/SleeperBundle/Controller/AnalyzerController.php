<?php declare(strict_types=1);

namespace SleeperBundle\Controller;

use JMS\Serializer\Serializer;
use SleeperBundle\Service\SleepService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AnalyzerController
{
    /** @var  SleepService */
    private $sleepService;

    /** @var  Serializer */
    private $serializer;

    /**
     * @param SleepService $sleepService
     * @param Serializer $serializer
     */
    public function __construct(SleepService $sleepService, Serializer $serializer) {
        $this->sleepService = $sleepService;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/")
     * @return JsonResponse
     */
    public function indexAction(): JsonResponse
    {
        $sleepModel = $this->sleepService->getSleepOnDate(new \DateTime());

        $sleepResponse = $this->serializer->serialize($sleepModel, 'json');

        return new JsonResponse($sleepResponse, 200, [], true);
    }
}
