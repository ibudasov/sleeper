<?php declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Domain\Model\Sleep;
use SleeperBundle\Domain\Repository\SleepRepositoryInterface;
use SleeperBundle\Domain\Service\SleepDomainService;

class SleepDomainServiceTest extends TestCase
{
    /** @var  SleepRepositoryInterface|MockInterface */
    private $repositoryMock;
    /** @var  Sleep|MockInterface */
    private $sleepMock;
    /** @var  SleepDomainService */
    private $domainService;

    protected function setUp()
    {
        $this->repositoryMock = \Mockery::mock(SleepRepositoryInterface::class);
        $this->sleepMock = \Mockery::mock(Sleep::class);
        $this->domainService = new SleepDomainService($this->repositoryMock);
    }

    public function testThatItRetrievesDataFromRepository(): void
    {
        $date = new \DateTime();

        $this->sleepMock->shouldReceive('getStartTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getEndTime')->once()->andReturn(new \DateTime());
        $this->sleepMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn(11);
        $this->sleepMock->shouldReceive('getLightSleepSeconds')->once()->andReturn(22);
        $this->sleepMock->shouldReceive('getAwakeSeconds')->once()->andReturn(33);
        $this->sleepMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn(44);

        $this->repositoryMock->shouldReceive('getSleepByDate')
            ->once()
            ->with($date)
            ->andReturn($this->sleepMock);

        self::assertInstanceOf(Sleep::class, $this->domainService->getSleepByDate($date));
    }
}
