<?php declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Model\Sleep;
use SleeperBundle\Model\SleepResponse;
use SleeperBundle\Repository\SleepRepositoryInterface;
use SleeperBundle\Service\SleepService;

class SleepServiceTest extends TestCase
{
    /** @var  SleepRepositoryInterface|MockInterface */
    private $repositoryMock;
    /** @var  Sleep|MockInterface */
    private $sleepMock;
    /** @var  SleepService */
    private $service;

    protected function setUp()
    {
        $this->repositoryMock = \Mockery::mock(SleepRepositoryInterface::class);
        $this->sleepMock = \Mockery::mock(Sleep::class);
        $this->service = new SleepService($this->repositoryMock);
    }

    public function testThatItRetrievesDataFromRepository()
    {
        $date = new \DateTime();

        $this->sleepMock->shouldReceive('getStartTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getEndTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn(11);
        $this->sleepMock->shouldReceive('getLightSleepSeconds')->once()->andReturn(22);
        $this->sleepMock->shouldReceive('getAwakeSeconds')->once()->andReturn(33);
        $this->sleepMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn(44);

        $this->repositoryMock->shouldReceive('getSleepOnDate')
            ->once()
            ->with($date)
            ->andReturn($this->sleepMock);

        self::assertInstanceOf(SleepResponse::class, $this->service->getSleepOnDate($date));
    }
}
