<?php

declare(strict_types=1);

use SleeperBundle\Application\Controller\IndexController;
use Symfony\Component\HttpFoundation\JsonResponse;

class IndexControllerTest extends \PHPUnit\Framework\TestCase
{
    public function testThatDummyResponseIsReturnedWhenNoPathIsSpecified(): void
    {
        $controller = new IndexController();
        $response = $controller->indexAction();

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals(
            \json_encode([
                'Sleeper API dummy response.',
                'For actual response -- look documentation: https://github.com/ibudasov/sleeper',
            ]),
            $response->getContent()
        );
    }
}
