<?php declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Model\Sleep;
use SleeperBundle\Model\SleepResponse;

class SleepResponseTest extends TestCase
{
    /** @var  Sleep|MockInterface */
    private $sleepMock;

    protected function setUp()
    {
        $this->sleepMock = \Mockery::mock(Sleep::class);
    }

    public function testThatSleepResponseModelCanBeCreatedGivenSleepModel()
    {
        $this->sleepMock->shouldReceive('getStartTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getEndTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn(11);
        $this->sleepMock->shouldReceive('getLightSleepSeconds')->once()->andReturn(22);
        $this->sleepMock->shouldReceive('getAwakeSeconds')->once()->andReturn(33);
        $this->sleepMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn(44);

        self::assertInstanceOf(SleepResponse::class, new SleepResponse($this->sleepMock));
    }
}
