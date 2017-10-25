<?php declare(strict_types=1);

namespace SleeperBundle\Controller\Response;

use JMS\Serializer\Annotation as Serializer;
use SleeperBundle\Model\Sleep;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class SleepResponse
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("startTime")
     * @var \DateTime
     */
    private $startTime;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("endTime")
     * @var \DateTime
     */
    private $endTime;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("deepSleepSeconds")
     * @var int
     */
    private $deepSleepSeconds;

    /** @var int */
    private $lightSleepSeconds;

    /** @var int */
    private $awakeSeconds;

    /** @var int */
    private $totalSleepSeconds;

    /** @param Sleep $sleep */
    public function __construct(Sleep $sleep)
    {
        $this->startTime = $sleep->getStartTime();
        $this->endTime = $sleep->getEndTime();
        $this->deepSleepSeconds = $sleep->getDeepSleepSeconds();
        $this->lightSleepSeconds = $sleep->getLightSleepSeconds();
        $this->awakeSeconds = $sleep->getAwakeSeconds();
        $this->totalSleepSeconds = $sleep->getTotalSleepSeconds();
    }
}
