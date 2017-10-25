<?php declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Controller\AnalyzerController;
use SleeperBundle\Model\SleepResponse;
use SleeperBundle\Service\SleepService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AnalyzerControllerTest extends TestCase
{
    /** @var  SleepService|MockInterface */
    private $sleepServiceMock;
    /** @var  SleepResponse */
    private $sleepResponseMock;

    protected function setUp()
    {
        $this->sleepServiceMock = \Mockery::mock(SleepService::class);
        $this->sleepResponseMock = \Mockery::mock(SleepResponse::class);
    }

    public function testThatCorrectResponseIsReturned()
    {
        $sleepAnalyzerController = new AnalyzerController($this->sleepServiceMock);

        $this->sleepServiceMock->shouldReceive('getSleepOnDate')
            ->once()
            ->andReturn($this->sleepResponseMock);

        self::assertInstanceOf(
            JsonResponse::class,
            $sleepAnalyzerController->indexAction()
        );
    }
}
