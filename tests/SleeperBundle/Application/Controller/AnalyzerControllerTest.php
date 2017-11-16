<?php declare(strict_types=1);

use JMS\Serializer\Serializer;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Controller\AnalyzerController;
use SleeperBundle\Application\Output\SleepOutput;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\Model\Sleep;
use SleeperBundle\Domain\Service\SleepService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AnalyzerControllerTest extends TestCase
{
    /** @var  SleepService|MockInterface */
    private $sleepServiceMock;
    /** @var  SleepOutput|MockInterface */
    private $sleepMock;
    /** @var  Serializer|MockInterface */
    private $serializerMock;
    /** @var AnalyzerController */
    private $controller;

    protected function setUp()
    {
        $this->sleepServiceMock = \Mockery::mock(SleepService::class);
        $this->sleepMock = \Mockery::mock(Sleep::class);
        $this->serializerMock = \Mockery::mock(Serializer::class);

        $this->controller = new AnalyzerController(
            $this->sleepServiceMock,
            $this->serializerMock
        );
    }

    public function testThatCorrectResponseIsReturned()
    {

        $this->sleepMock->shouldReceive('getStartTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getEndTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn(11);
        $this->sleepMock->shouldReceive('getLightSleepSeconds')->once()->andReturn(22);
        $this->sleepMock->shouldReceive('getAwakeSeconds')->once()->andReturn(33);
        $this->sleepMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn(44);

        $this->serializerMock->shouldReceive('serialize')
            ->once()
            ->andReturn('{"startTime":"2017-09-24 22:06:30","endTime":"2017-09-25 07:37:53","deepSleepSeconds":18779}');

        $this->sleepServiceMock->shouldReceive('getSleepByDate')
            ->once()
            ->andReturn($this->sleepMock);

        self::assertInstanceOf(
            JsonResponse::class,
            $this->controller->indexAction(new \DateTime())
        );
    }

    public function testThatExceptionIsThrownWhenSleepNotFound()
    {
        self::expectException(SleepByDateNotFoundException::class);

        $this->sleepServiceMock->shouldReceive('getSleepByDate')
            ->once()
            ->andThrow(SleepByDateNotFoundException::class);

        $this->controller->indexAction(new \DateTime());
    }
}
