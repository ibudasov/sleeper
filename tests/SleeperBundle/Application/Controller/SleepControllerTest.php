<?php declare(strict_types=1);

use JMS\Serializer\Serializer;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Controller\SleepController;
use SleeperBundle\Application\Output\SleepOutput;
use SleeperBundle\Domain\Exception\SleepByDateNotFoundException;
use SleeperBundle\Domain\Model\Sleep;
use SleeperBundle\Domain\Service\SleepDomainService;
use Symfony\Component\HttpFoundation\JsonResponse;

class SleepControllerTest extends TestCase
{
    /** @var  SleepDomainService|MockInterface */
    private $sleepDomainServiceMock;
    /** @var  SleepOutput|MockInterface */
    private $sleepMock;
    /** @var  Serializer|MockInterface */
    private $serializerMock;
    /** @var SleepController */
    private $controller;

    protected function setUp()
    {
        $this->sleepDomainServiceMock = \Mockery::mock(SleepDomainService::class);
        $this->sleepMock = \Mockery::mock(Sleep::class);
        $this->serializerMock = \Mockery::mock(Serializer::class);

        $this->controller = new SleepController(
            $this->sleepDomainServiceMock,
            $this->serializerMock
        );
    }

    public function testThatCorrectResponseIsReturned(): void
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

        $this->sleepDomainServiceMock->shouldReceive('getSleepByDate')
            ->once()
            ->andReturn($this->sleepMock);

        $response = $this->controller->sleepByDateAction(new \DateTime());

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals(200, $response->getStatusCode());
    }

    public function testThatExceptionIsThrownWhenSleepNotFound(): void
    {
        $this->sleepDomainServiceMock->shouldReceive('getSleepByDate')
            ->once()
            ->andThrow(SleepByDateNotFoundException::class);

        $response = $this->controller->sleepByDateAction(new \DateTime());

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals(404, $response->getStatusCode());
    }
}
