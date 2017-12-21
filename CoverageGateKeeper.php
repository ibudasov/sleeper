<?php

declare(strict_types=1);

class CoverageGateKeeper
{
    /** @var int  */
    private static $threshold = 100;
    private static $divider = "\n----------------------------\n";

    /** @param string $cloverCoverageReport */
    public static function check(string $cloverCoverageReport): void
    {
        if(false == file_exists($cloverCoverageReport)) {
            throw new \RuntimeException('File not found');
        }

        $actualCoverage = self::analyzeClover($cloverCoverageReport);


        if (self::analyzeClover($cloverCoverageReport) < self::$threshold) {
            echo \sprintf(
                self::$divider . "%s percent of coverage is lower than expected %s \n Check the report: %s" . self::$divider,
                $actualCoverage,
                self::$threshold,
                $cloverCoverageReport
            );
            exit(1);
        }

        echo \sprintf(
            self::$divider . "%s percent of coverage is lekker! \n Check the report: %s" . self::$divider,
            $actualCoverage,
            $cloverCoverageReport
        );

        exit(0);
    }

    /**
     * @param string $file
     * @return float
     */
    private static function analyzeClover(string $cloverReportFile): float
    {
        $xml = new \SimpleXMLElement(file_get_contents($cloverReportFile));
        $metrics = $xml->xpath('//metrics');

        $totalElements = 0;
        $coveredElements = 0;

        foreach ($metrics as $metric) {
            $totalElements += (int) $metric['statements'];
            $coveredElements += (int) $metric['coveredstatements'];
        }

        return round($coveredElements / $totalElements * 100, 2);
    }
}