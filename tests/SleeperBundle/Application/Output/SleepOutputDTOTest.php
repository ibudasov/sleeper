<?php

declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Output\SleepOutputDTO;
use SleeperBundle\Domain\Entity\Sleep;

class SleepOutputDTOTest extends TestCase
{
    /** @var Sleep|MockInterface */
    private $sleepMock;

    protected function setUp()
    {
        $this->sleepMock = \Mockery::mock(Sleep::class);
    }

    public function testThatSleepResponseModelCanBeCreatedGivenSleepModel(): void
    {
        $this->sleepMock->shouldReceive('getStartTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getEndTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn(11);
        $this->sleepMock->shouldReceive('getLightSleepSeconds')->once()->andReturn(22);
        $this->sleepMock->shouldReceive('getAwakeSeconds')->once()->andReturn(33);
        $this->sleepMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn(44);

        self::assertInstanceOf(SleepOutputDTO::class, new SleepOutputDTO($this->sleepMock));
    }
}
