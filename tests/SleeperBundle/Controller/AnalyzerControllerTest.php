<?php declare(strict_types=1);

use JMS\Serializer\Serializer;
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
    /** @var  SleepResponse|MockInterface */
    private $sleepResponseMock;
    /** @var  Serializer|MockInterface */
    private $serializerMock;

    protected function setUp()
    {
        $this->sleepServiceMock = \Mockery::mock(SleepService::class);
        $this->sleepResponseMock = \Mockery::mock(SleepResponse::class);
        $this->serializerMock = \Mockery::mock(Serializer::class);
    }

    public function testThatCorrectResponseIsReturned()
    {
        $sleepAnalyzerController = new AnalyzerController(
            $this->sleepServiceMock,
            $this->serializerMock
        );

        $this->serializerMock->shouldReceive('serialize')
            ->once()
            ->andReturn('{"startTime":"2017-09-24 22:06:30","endTime":"2017-09-25 07:37:53","deepSleepSeconds":18779}');

        $this->sleepServiceMock->shouldReceive('getSleepOnDate')
            ->once()
            ->andReturn($this->sleepResponseMock);

        self::assertInstanceOf(
            JsonResponse::class,
            $sleepAnalyzerController->indexAction()
        );
    }
}
