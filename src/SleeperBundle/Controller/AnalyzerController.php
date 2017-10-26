<?php declare(strict_types=1);

namespace SleeperBundle\Controller;

use JMS\Serializer\Serializer;
use SleeperBundle\Service\SleepService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Route("/sleep/{date}")
     *
     * @ParamConverter("date", options={"format": "Y-m-d"})
     *
     * @param \DateTime $date
     * @return JsonResponse
     */
    public function indexAction(\DateTime $date): JsonResponse
    {
        $sleepModel = $this->sleepService->getSleepOnDate($date);

        $sleepResponse = $this->serializer->serialize($sleepModel, 'json');

        return new JsonResponse($sleepResponse, 200, [], true);
    }
}
