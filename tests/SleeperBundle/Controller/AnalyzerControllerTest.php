<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SleeperBundle\Controller\AnalyzerController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AnalyzerControllerTest extends TestCase
{
    /** @var \Psr\Log\LoggerInterface */
    private $loggerMock;

    protected function setUp()
    {
        $this->loggerMock = \Mockery::mock(\Psr\Log\LoggerInterface::class);
    }

    public function testThatCorrectResponseIsReturned()
    {
        self::assertInstanceOf(
            JsonResponse::class,
            (new AnalyzerController($this->loggerMock))->indexAction()
        );
    }
}
