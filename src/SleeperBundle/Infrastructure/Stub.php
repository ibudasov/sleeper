<?php

declare(strict_types=1);

namespace SleeperBundle\Infrastructure;

class Stub
{
    /**
     * @var array
     */
    private $stubCollection = [];

    public function __construct()
    {
        $this->getSleepByDateStub();
    }

    /**
     * @param string $postUrl
     * @param string $postJsonBody
     * @param string $response
     */
    public function add(string $postUrl, string $postJsonBody, string $response): void
    {
        $this->stubCollection = [
            $postUrl.' -- '.$postJsonBody => $response,
        ];
    }

    /**
     * @param string $url
     * @param string $body
     *
     * @return string
     */
    public function getStubMatching(string $url, string $body): string
    {
        if (isset($this->stubCollection[$url . ' -- ' . $body])) {
            return $this->stubCollection[$url . ' -- ' . $body];
        }

        return '{
            "took": 10,
            "timed_out": false,
            "_shards": {
                "total": 5,
                "successful": 5,
                "skipped": 0,
                "failed": 0
            },
            "hits": {
                "total": 0,
                "max_score": null,
                "hits": [
                ]
            }
        }';
    }

    private function getSleepByDateStub(): void
    {
        $requestedDate = new \DateTime();
        $startOfPeriod = $requestedDate->modify('midnight');
        $endOfPeriod = clone $requestedDate;
        $endOfPeriod->modify('tomorrow');

        $requestBody = [
            'query' => [
                'constant_score' => [
                    'filter' => [
                        'range' => [
                            'startTime' => [
                                'gte' => $startOfPeriod->format(ElasticsearchGateway::ELASTICSEARCH_DATE_FORMAT),
                                'lte' => $endOfPeriod->format(ElasticsearchGateway::ELASTICSEARCH_DATE_FORMAT),
                            ],
                        ],
                    ],
                ],
            ],
        ];


        $response = '{
            "took": 10,
            "timed_out": false,
            "_shards": {
                "total": 5,
                "successful": 5,
                "skipped": 0,
                "failed": 0
            },
            "hits": {
                "total": 1,
                "max_score": 1,
                "hits": [
                    {
                        "_index": "sleep",
                        "_type": "night",
                        "_id": "1",
                        "_score": 1,
                        "_source": {
                            "id": "111",
                            "startTime": "' . $startOfPeriod->format(ElasticsearchGateway::ELASTICSEARCH_DATE_FORMAT) . '",
                            "endTime": "' . $endOfPeriod->format(ElasticsearchGateway::ELASTICSEARCH_DATE_FORMAT) . '",
                            "lightSleepSeconds": 1,
                            "deepSleepSeconds": 2,
                            "awakeSeconds": 3,
                            "totalSleepSeconds": 4
                        }
                    }
                ]
            }
        }';

        $this->add('localhost:9200/sleep/_search/', \json_encode($requestBody), $response);
    }
}
