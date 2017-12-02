<?php declare(strict_types=1);

use JMS\Serializer\Serializer;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Controller\SleepController;
use SleeperBundle\Application\Output\SleepOutput;
use SleeperBundle\Application\Service\SleepService;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;

class SleepControllerTest extends TestCase
{
    /** @var  SleepService|MockInterface */
    private $sleepService;
    /** @var  SleepOutput|MockInterface */
    private $sleepOutputMock;
    /** @var  Serializer|MockInterface */
    private $serializerMock;
    /** @var SleepController */
    private $controller;

    protected function setUp()
    {
        $this->sleepService = \Mockery::mock(SleepService::class);
        $this->sleepOutputMock = \Mockery::mock(SleepOutput::class);
        $this->serializerMock = \Mockery::mock(Serializer::class);

        $this->controller = new SleepController(
            $this->sleepService,
            $this->serializerMock
        );
    }

    public function testThatCorrectResponseIsReturned(): void
    {

        $this->sleepOutputMock->shouldReceive('getStartTime')->once()->andReturn(new \DateTime());
        $this->sleepOutputMock->shouldReceive('getEndTime')->once()->andReturn(new \DateTime());
        $this->sleepOutputMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn(11);
        $this->sleepOutputMock->shouldReceive('getLightSleepSeconds')->once()->andReturn(22);
        $this->sleepOutputMock->shouldReceive('getAwakeSeconds')->once()->andReturn(33);
        $this->sleepOutputMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn(44);

        $this->serializerMock->shouldReceive('serialize')
            ->once()
            ->andReturn('{"startTime":"2017-09-24 22:06:30","endTime":"2017-09-25 07:37:53","deepSleepSeconds":18779}');

        $this->sleepService->shouldReceive('getSleepByDate')
            ->once()
            ->andReturn($this->sleepOutputMock);

        $response = $this->controller->sleepByDateAction(new \DateTime());

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals(200, $response->getStatusCode());
    }

    public function testThatExceptionIsThrownWhenSleepNotFound(): void
    {
        $this->sleepService->shouldReceive('getSleepByDate')
            ->once()
            ->andThrow(SleepByDateNotFoundException::class);

        $response = $this->controller->sleepByDateAction(new \DateTime());

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals(404, $response->getStatusCode());
    }
}
