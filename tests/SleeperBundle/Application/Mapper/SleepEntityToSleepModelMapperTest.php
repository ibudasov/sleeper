<?php declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Application\Entity\SleepEntity;
use SleeperBundle\Application\Mapper\SleepEntityToSleepModelMapper;
use SleeperBundle\Domain\Model\Sleep;

class SleepEntityToSleepModelMapperTest extends TestCase
{
    /** @var SleepEntity|MockInterface */
    private $sleepEntityMock;
    /** @var Sleep|MockInterface */
    private $sleepMock;

    protected function setUp()
    {
        $this->sleepEntityMock = \Mockery::mock(SleepEntity::class);
        $this->sleepMock = \Mockery::mock(Sleep::class);
    }

    public function testThatSleepEntityCanBeMappedToModel(): void
    {
        $startTime = new \DateTimeImmutable();
        $endTime = new \DateTimeImmutable();
        $deepSleepSeconds = 1;
        $lightSleepSeconds = 1;
        $awakeSeconds = 1;
        $totalSleepSeconds = 1;

        $this->sleepEntityMock->shouldReceive('getStartTime')->once()->andReturn($startTime);
        $this->sleepEntityMock->shouldReceive('getEndTime')->once()->andReturn($endTime);
        $this->sleepEntityMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn($deepSleepSeconds);
        $this->sleepEntityMock->shouldReceive('getLightSleepSeconds')->once()->andReturn($lightSleepSeconds);
        $this->sleepEntityMock->shouldReceive('getAwakeSeconds')->once()->andReturn($awakeSeconds);
        $this->sleepEntityMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn($totalSleepSeconds);

        $mappingResult = SleepEntityToSleepModelMapper::map($this->sleepEntityMock);

        self::assertInstanceOf(Sleep::class, $mappingResult);
        self::assertEquals($startTime, $mappingResult->getStartTime());
        self::assertEquals($endTime, $mappingResult->getEndTime());
        self::assertEquals($deepSleepSeconds, $mappingResult->getDeepSleepSeconds());
        self::assertEquals($lightSleepSeconds, $mappingResult->getLightSleepSeconds());
        self::assertEquals($awakeSeconds, $mappingResult->getAwakeSeconds());
        self::assertEquals($totalSleepSeconds, $mappingResult->getTotalSleepSeconds());
    }
}
