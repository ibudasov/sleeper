<?php declare(strict_types=1);

namespace SleeperBundle\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class AnalyzerController
{
    /** @var LoggerInterface */
    private $logger;

    /** @param LoggerInterface $logger */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/")
     * @return JsonResponse
     */
    public function indexAction(): JsonResponse
    {
        return new JsonResponse('ok');
    }
}
