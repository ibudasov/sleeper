<?php declare(strict_types=1);

namespace SleeperBundle\Application\Controller;

use JMS\Serializer\Serializer;
use SleeperBundle\Application\Mapper\SleepModelToSleepResponseMapper;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\Service\SleepService;
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
     *
     * @return JsonResponse
     * @throws SleepByDateNotFoundException
     */
    public function indexAction(\DateTime $date): JsonResponse
    {
        $sleep = $this->sleepService->getSleepByDate($date);

        $sleepResponse = SleepModelToSleepResponseMapper::map($sleep);

        $serializedResponse = $this->serializer->serialize($sleepResponse, 'json');

        return new JsonResponse($serializedResponse, 200, [], true);
    }
}
