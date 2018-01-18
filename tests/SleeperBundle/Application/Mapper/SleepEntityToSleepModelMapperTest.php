<?php

declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Entity\SleepDoctrineEntity;
use SleeperBundle\Application\Mapper\SleepDoctrineEntityToDomainEntityMapper;
use SleeperBundle\Domain\Entity\Sleep;

class SleepEntityToSleepModelMapperTest extends TestCase
{
    /** @var SleepDoctrineEntity|MockInterface */
    private $sleepEntityMock;
    /** @var Sleep|MockInterface */
    private $sleepMock;

    protected function setUp()
    {
        $this->sleepEntityMock = \Mockery::mock(SleepDoctrineEntity::class);
        $this->sleepMock = \Mockery::mock(Sleep::class);
    }

    public function testThatSleepEntityCanBeMappedToModel(): void
    {
        $id = 'random-id';
        $startTime = new \DateTime();
        $endTime = new \DateTime();
        $deepSleepSeconds = 1;
        $lightSleepSeconds = 1;
        $awakeSeconds = 1;
        $totalSleepSeconds = 5;

        $this->sleepEntityMock->shouldReceive('getId')->once()->andReturn($id);
        $this->sleepEntityMock->shouldReceive('getStartTime')->once()->andReturn($startTime);
        $this->sleepEntityMock->shouldReceive('getEndTime')->once()->andReturn($endTime);
        $this->sleepEntityMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn($deepSleepSeconds);
        $this->sleepEntityMock->shouldReceive('getLightSleepSeconds')->once()->andReturn($lightSleepSeconds);
        $this->sleepEntityMock->shouldReceive('getAwakeSeconds')->once()->andReturn($awakeSeconds);
        $this->sleepEntityMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn($totalSleepSeconds);

        $mappingResult = SleepDoctrineEntityToDomainEntityMapper::map($this->sleepEntityMock);

        self::assertInstanceOf(Sleep::class, $mappingResult);
        self::assertEquals($id, $mappingResult->getId());
        self::assertEquals($startTime, $mappingResult->getStartTime());
        self::assertEquals($endTime, $mappingResult->getEndTime());
        self::assertEquals($deepSleepSeconds, $mappingResult->getDeepSleepSeconds());
        self::assertEquals($lightSleepSeconds, $mappingResult->getLightSleepSeconds());
        self::assertEquals($awakeSeconds, $mappingResult->getAwakeSeconds());
        self::assertEquals($totalSleepSeconds, $mappingResult->getTotalSleepSeconds());
    }
}
