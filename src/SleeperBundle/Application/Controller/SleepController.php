<?php declare(strict_types=1);

namespace SleeperBundle\Application\Controller;

use JMS\Serializer\SerializerInterface;
use SleeperBundle\Application\Service\SleepService;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SleepController
{
    /** @var  SleepService */
    private $sleepService;

    /** @var  SerializerInterface */
    private $serializer;

    /**
     * @param SleepService $sleepService
     * @param SerializerInterface $serializer
     */
    public function __construct(SleepService $sleepService, SerializerInterface $serializer)
    {
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
     */
    public function sleepByDateAction(\DateTime $date): JsonResponse
    {
        try {
            $sleepOutput = $this->sleepService->getSleepByDate($date);

            $serializedResponse = $this->serializer->serialize($sleepOutput, 'json');

            return new JsonResponse($serializedResponse, 200, [], true);
        } catch (SleepByDateNotFoundException $exception) {
            return new JsonResponse('Sleep not found, sorry', 404);
        }
    }
}
