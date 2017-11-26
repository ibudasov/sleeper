<?php declare(strict_types=1);

namespace SleeperBundle\Application\Controller;

use JMS\Serializer\Serializer;
use SleeperBundle\Application\Service\SleepService;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SleepController
{
    /** @var  SleepService */
    private $sleepService;

    /** @var  Serializer */
    private $serializer;

    /**
     * @param SleepService $sleepService
     * @param Serializer $serializer
     */
    public function __construct(SleepService $sleepService, Serializer $serializer)
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
            $sleepOutput = $this->sleepService->getSleepByDate(
                \DateTimeImmutable::createFromMutable($date)
            );

            $serializedResponse = $this->serializer->serialize($sleepOutput, 'json');

            return new JsonResponse($serializedResponse, 200, [], true);
        } catch (SleepByDateNotFoundException $exception) {
            return new JsonResponse('Sleep not found, sorry', 404);
        }
    }
}
