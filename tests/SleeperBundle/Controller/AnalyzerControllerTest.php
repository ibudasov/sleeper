<?php declare(strict_types=1);

use JMS\Serializer\Serializer;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Controller\AnalyzerController;
use SleeperBundle\Controller\Response\SleepResponse;
use SleeperBundle\Service\SleepService;
use Symfony\Component\HttpFoundation\JsonResponse;
use SleeperBundle\Model\Sleep;

class AnalyzerControllerTest extends TestCase
{
    /** @var  SleepService|MockInterface */
    private $sleepServiceMock;
    /** @var  SleepResponse|MockInterface */
    private $sleepMock;
    /** @var  Serializer|MockInterface */
    private $serializerMock;

    protected function setUp()
    {
        $this->sleepServiceMock = \Mockery::mock(SleepService::class);
        $this->sleepMock = \Mockery::mock(Sleep::class);
        $this->serializerMock = \Mockery::mock(Serializer::class);
    }

    public function testThatCorrectResponseIsReturned()
    {
        $analyzerController = new AnalyzerController(
            $this->sleepServiceMock,
            $this->serializerMock
        );

        $this->sleepMock->shouldReceive('getStartTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getEndTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn(11);
        $this->sleepMock->shouldReceive('getLightSleepSeconds')->once()->andReturn(22);
        $this->sleepMock->shouldReceive('getAwakeSeconds')->once()->andReturn(33);
        $this->sleepMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn(44);

        $this->serializerMock->shouldReceive('serialize')
            ->once()
            ->andReturn('{"startTime":"2017-09-24 22:06:30","endTime":"2017-09-25 07:37:53","deepSleepSeconds":18779}');

        $this->sleepServiceMock->shouldReceive('getSleepOnDate')
            ->once()
            ->andReturn($this->sleepMock);

        self::assertInstanceOf(
            JsonResponse::class,
            $analyzerController->indexAction(new \DateTime())
        );
    }
}
