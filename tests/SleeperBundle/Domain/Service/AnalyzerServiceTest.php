<?php declare(strict_types=1);

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SleeperBundle\Domain\Model\Sleep;
use SleeperBundle\Domain\Service\AnalyzerService;

class AnalyzerServiceTest extends TestCase
{
    /** @var  Sleep|MockInterface */
    private $sleepMock;
    /** @var  AnalyzerService */
    private $analyzerService;

    protected function setUp()
    {
        $this->sleepMock = \Mockery::mock(Sleep::class);
        $this->analyzerService = new AnalyzerService();
    }

    public function testThatSuccessOfSleepCanBeAnalyzedAndNumberOfPercentIsReturned()
    {
        $this->sleepMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn('8000');
        $this->sleepMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn('4000');

        self::assertEquals(50, $this->analyzerService->getSuccessResultInPercent($this->sleepMock));
        self::assertInternalType('float', $this->analyzerService->getSuccessResultInPercent($this->sleepMock));
    }

    public function testThatSleepIsConsideredUnsuccessfulGivenSuccessPercentageLessThan50()
    {
        $this->sleepMock->shouldReceive('getTotalSleepSeconds')->once()->andReturn('10000');
        $this->sleepMock->shouldReceive('getDeepSleepSeconds')->once()->andReturn('3000');

        self::assertFalse($this->analyzerService->isSuccessful($this->sleepMock));
    }
}
