<?php declare(strict_types=1);

namespace SleeperBundle\Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="SleeperBundle\Repository\DatabaseSleepRepository")
 */
class SleepEntity
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeImmutable
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeImmutable
     */
    private $endTime;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $deepSleepSeconds;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $lightSleepSeconds;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $awakeSeconds;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $totalSleepSeconds;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getStartTime(): \DateTimeImmutable
    {
        return $this->startTime;
    }

    /**
     * @param \DateTimeImmutable $startTime
     */
    public function setStartTime(\DateTimeImmutable $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getEndTime(): \DateTimeImmutable
    {
        return $this->endTime;
    }

    /**
     * @param \DateTimeImmutable $endTime
     */
    public function setEndTime(\DateTimeImmutable $endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return int
     */
    public function getDeepSleepSeconds(): int
    {
        return $this->deepSleepSeconds;
    }

    /**
     * @param int $deepSleepSeconds
     */
    public function setDeepSleepSeconds(int $deepSleepSeconds): void
    {
        $this->deepSleepSeconds = $deepSleepSeconds;
    }

    /**
     * @return int
     */
    public function getLightSleepSeconds(): int
    {
        return $this->lightSleepSeconds;
    }

    /**
     * @param int $lightSleepSeconds
     */
    public function setLightSleepSeconds(int $lightSleepSeconds): void
    {
        $this->lightSleepSeconds = $lightSleepSeconds;
    }

    /**
     * @return int
     */
    public function getAwakeSeconds(): int
    {
        return $this->awakeSeconds;
    }

    /**
     * @param int $awakeSeconds
     */
    public function setAwakeSeconds(int $awakeSeconds): void
    {
        $this->awakeSeconds = $awakeSeconds;
    }

    /**
     * @return int
     */
    public function getTotalSleepSeconds(): int
    {
        return $this->totalSleepSeconds;
    }

    /**
     * @param int $totalSleepSeconds
     */
    public function setTotalSleepSeconds(int $totalSleepSeconds): void
    {
        $this->totalSleepSeconds = $totalSleepSeconds;
    }
}
